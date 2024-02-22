<?php 
class Cinescuela
{
    public $domain = "https://oblicua.co/lab/cinescuela/admin/wp-json/wp/v2/";
    public $generalInfo = array();
    public $language = "es";
    public $production = true;

    function __construct($language = "es", $development = false){
        if ($development) {
            $this->production = false;
        }
        $this->language = $language;
        $this->generalInfo = $this->gHomeInfo();
    }
    public function query($endpoint, $body = "", $method = "GET", $page = 1, $per_page = 50, $extra = [], $cache = false){
        $query = ['langcode' => $this->language, "page" => $page, "per_page" => $per_page];

        // Ruta donde se va a guardar todos los archivos de CACHE
        $cacheAbsoluteRoute = "/home3/newlab/public_html/garciarental/cache";

        // Validación de la variable $extra para colocar queryParams en el ENDPOINT
        if ($extra) {
            $extra_params = [];
            foreach ($extra as $param) {
                list($key, $value) = explode('=', $param);
                $extra_params[$key] = $value;
            }
            $query = array_merge($query, $extra_params);
        }

        $query_string = http_build_query($query);
        $url = "{$this->domain}{$endpoint}?{$query_string}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Set request body for POST and PUT methods
        if ($method === "POST" || $method === "PUT") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        if ($cache) {
            $filetitle = $this->get_alias($endpoint) . ".json";
            if (!file_exists($cacheAbsoluteRoute)) {
                mkdir($cacheAbsoluteRoute, 0777, true);
            }
            $path = $cacheAbsoluteRoute . "/" . $filetitle;

            if (file_exists($path)) {
                $data = file_get_contents($path);
                $response = json_decode($data);
                return ['response' => $response, 'total_pages' => $response->total_pages, 'total_posts' => $response->total_posts];
            } else {
                $output = curl_exec($ch);
                $request = json_decode($output);
                $finalstructure = '{"endpoint":"' . $endpoint . '","lastUpdate":"' . date("Y-m-d") . '","response":' . $output . '}';
                $bwriting = file_put_contents($path, $finalstructure);
                curl_close($ch);
                return ['response' => $request, 'total_pages' => $request->headers['X-WP-TotalPages'], 'total_posts' => $request->headers['X-WP-Total']];
            }
        } else {
            $output = curl_exec($ch);
            $request = json_decode($output);
            curl_close($ch);
            return ['response' => $request, 'total_pages' => $request->headers['X-WP-TotalPages'], 'total_posts' => $request->headers['X-WP-Total']];
        }
    }

    function gHomeInfo() {
        $gnrl = array();
        if (isset($_SESSION[$this->language]['gHomeInfo'])) {
            $gnrl = $_SESSION['gHomeInfo'];
        } else {
            $resultES = $this->query("pages/8695");
            $resultFR = $this->query("pages/8769");

            $gnrl = array();

            function modifyPropertyNames($item) {
                $modifiedItem = (object)array(
                    "tit_gnrl" => $item->acf->titulo_home,
                    "main_fie" => $item->acf->titulo_home,
                    "face_gnrl" => $item->acf->url_facebook,
                    "twitt_gnrl" => $item->acf->url_twitter,
                    "chanYT_gnrl" => $item->acf->url_canal_youtube,
                    "filmonth_gnrl" => $item->acf->peliculas_del_mes,
                    "cyclemonth_gnrl" => $item->acf->ciclo_del_mes,
                    "numcit_gnrl" => $item->acf->numero_de_ciudades_banner,
                    "numscho_gnrl" => $item->acf->numero_de_escuelas_banner,
                    "logone_gnrl" => $item->acf->logo_1_banner,
                    "logtwo_gnrl" => $item->acf->logo_2_banner,
                    "wordone_gnrl" => $item->acf->palabra_1_banner,
                    "wordtwo_gnrl" => $item->acf->palabra_2_banner,
                    "textbutton_gnrl" => $item->acf->texto_boton_banner,
                    "linkbanner_gnrl" => $item->acf->pie_de_banner,
                    "copyright_gnrl" => $item->acf->copyright,
                    "imgbanner_gnrl" => $item->acf->imagen_banner,
                    "imgogseo_meta" => $item->acf->imagen_para_el_open_graph,
                    "titseo_meta" => $item->acf->titulo_de_la_ventana,
                    "keywseo_meta" => $item->acf->palabras_clave_de_esta_publicacion,
                    "metadseo_meta" => $item->acf->meta_descripcion,
                );
            
                return $modifiedItem;
            }
            $modifiedDataES = modifyPropertyNames($resultES["response"]);
            $modifiedDataFR = modifyPropertyNames($resultFR["response"]);
    
            $gnrl["es"] = $modifiedDataES;
            $gnrl["fr"] = $modifiedDataFR;
            $_SESSION['gHomeInfo'] = $gnrl;
        }
        return $gnrl;
    }
    function consultarRecursos($recurso, $ids = "", $body = "", $method = "GET", $page = 1, $per_page = 50, $extra = [], $cache = false) {
        // Variable para almacenar los resultados de la consulta
        $resultados = [];
        // Verificar si se proporcionaron IDs
        if ($ids !== "") {
            // Verificar si $ids es una cadena (un solo ID) o un arreglo (múltiples IDs)
            if (is_string($ids)) {
                // Si es una cadena (un solo ID), hacer la consulta para ese ID y almacenar el resultado
                $resultados =  $this->query($recurso."/".$ids, $body, $method, $page, $per_page, $extra, $cache);
            } else {
                // Si es un arreglo (múltiples IDs), hacer una consulta por cada uno
                foreach ($ids as $id) {
                    $resultados[] = $this->query($recurso."/".$id, $body, $method, $page, $per_page, $extra, $cache);
                }
            }
        } else {
            // Si no se proporcionan IDs, hacer una consulta general sin IDs y almacenar el resultado
            $resultados = $this->query($recurso, $body, $method, $page, $per_page, $extra, $cache);
        }
        // Retornar los resultados de la consulta
        return $resultados;
    }
    function getPeliculas($ids = "", $page = 1, $per_page = 50, $extra = []) {
        $peliculas = $this->consultarRecursos("cinescuela-movies", $ids, "", "GET", $page, $per_page, [], false);
        return $peliculas;
    }
    function getCiclos($ids = "") {
        $ciclos = $this->consultarRecursos("cinescuela-ciclo", $ids);
        return $ciclos;
    }
    function getSliderPrincipales($ids = "") {
        $slprin = $this->consultarRecursos("cinescuela-slprin");
        return $slprin["response"];
    }
    function getSliderSecundarios($ids = "") {
        $slsec = $this->consultarRecursos("cinescuela-slsec");
        return $slsec["response"];
    }
    function getAsignaturas($ids = "") {
        $slsec = $this->consultarRecursos("cinescuela-subjects");
        return $slsec["response"];
    }
    function getTematicas($ids = "") {
        $slsec = $this->consultarRecursos("cinescuela-tematicas");
        return $slsec["response"];
    }
    
}
?>