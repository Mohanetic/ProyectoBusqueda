<?php 

  require 'simple_html_dom.php';
            
    function TamanoImg($imagen) {
        
      $xpath = new DOMXPath(@DOMDocument::loadHTML($imagen));
      $src = $xpath->evaluate("string(//img/@src)");

      preg_match('/(src=["\'](.*?)["\'])/', $imagen, $match);
      $split = preg_split('/["\']/', $match[0]);

      $src = $split[1];

      return $src;
    }

    function EstiloTitulo($titulo) {
        
      $xpath = new DOMXPath(@DOMDocument::loadHTML($titulo));
      $href = $xpath->evaluate("string(//a/@href)");
      $text = strip_tags($titulo);

      return $tituloNuevo = "<a href='$href'>$text</a>";
    }

    function EstiloPrecio($valor) {
    
      $valor2 = strip_tags($valor);

      $valor2 = explode('$', $valor2);

      $valor2 = intval(str_replace(".","",$valor2[1]));

      $valor2 = number_format($valor2,0,"",".");

      return $ValorNuevo = "$valor2";
    }

    function sort_by_orden ($a, $b) {

      return $a['Precio'] - $b['Precio'];
    }

    //---------------------------------------------------------------------------------------------------------------------------------------
    //SOLOTODO-------------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST['Buscador'])) {
        
      $busqueda = $_POST['Buscador'];

      $counter = 0 ;

      $html = new simple_html_dom();

      if (empty($busqueda)) {
        $busqueda = "monitor";
      }

      $url = 'https://www.solotodo.com/search/?keywords='. $busqueda;

      $html = file_get_html($url);

      if ( !empty($html)) {

        $titles = $html->find('div[class=search_result]');

        foreach($titles as $title )
        {
          $titulo = $title->find('h4 a',0);
          $imagen = $title->find('a img',0);
          $valor  = $title->find('div[class=with_margin_top] a',0);

          $Datos[$counter]["Titulo"] = EstiloTitulo($titulo);
          $Datos[$counter]["Imagen"] = TamanoImg($imagen);
          $Datos[$counter]["Precio"] = EstiloPrecio($valor);
          $Datos[$counter]["Tienda"] = "<img src='imagenes/logo_solotodo.svg' border='0' style='width:32%;float:right;margin-top:5%;'>";

          $counter++;       
        }
      }

      //---------------------------------------------------------------------------------------------------------------------------------------
      //PARIS----------------------------------------------------------------------------------------------------------------------------------

      $url = 'https://busqueda.paris.cl/busca?storeId=10801&catalogId=40000000629&langId=-5&pageSize=30&beginIndex=0&searchSource=Q&sType=SimpleSearch&resultCatEntryType=2&showResultsPage=true&pageView=image&q='. $busqueda;

      $html = file_get_html($url);

      if ( !empty($html)) {

        $titles = $html->find('li[class=nm-product-item]');

        foreach($titles as $title )
        {   
          $valor  = $title->find('div[class=nm-price-value]',0);
          $titulo = $title->find('h2 a',0);
          $imagen = $title->find('div[class=nm-product-img-container] a img',0);

          $Datos[$counter]["Titulo"] = EstiloTitulo($titulo);
          $Datos[$counter]["Imagen"] = TamanoImg($imagen);
          $Datos[$counter]["Precio"] = EstiloPrecio($valor);
          $Datos[$counter]["Tienda"] = "<img src='imagenes/logo_paris.png' border='0' style='width:26%;float:right;margin-top:6%;'>";

          $counter++;
        }
      }

      //---------------------------------------------------------------------------------------------------------------------------------------
      //RIPLEY---------------------------------------------------------------------------------------------------------------------------------

      $url = 'https://simple.ripley.cl/search/'. $busqueda;

      $html = file_get_html($url);

      if ( !empty($html)) {

        $titles = $html->find('a[class=catalog-product]');

        foreach($titles as $title )
        {   
          $valor  = $title->find('span[class=catalog-product-offer-price]',0);
          $titulo = $title->find('span[class=js-clamp catalog-product-name]',0);
          $imagen = $title->find('div[class=product-image-wrapper] img',0);
          
          $Datos[$counter]["Titulo"] = EstiloTitulo($titulo);
          $Datos[$counter]["Imagen"] = TamanoImg($imagen);
          $Datos[$counter]["Precio"] = EstiloPrecio($valor);
          $Datos[$counter]["Tienda"] = "<img src='imagenes/logo_ripley.png' border='0' style='width:32%;float:right;margin-top:18%;'>";

          $counter++;          
        }
      }

      //---------------------------------------------------------------------------------------------------------------------------------------

      usort($Datos, 'sort_by_orden');

      $longitud = count($Datos);
       
      for($i=0; $i<$longitud; $i++)
      {        
        echo "<ul style='list-style: none; border:1px solid #d8d8d8; border-radius: 4px; height: 60 %; width:22%; float: left; margin: 5px;padding: 1.25em; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);'>
                <li Style='height:25px; font-size:14px;'> ". $Datos[$i]['Titulo'] ." </li> </br>
                <li Style='height:150px;'> <img src='". $Datos[$i]['Imagen'] ."' Style='width: 70%; display: block; margin-left: auto; margin-right: auto; padding-top: 6%;'> </li> </br>
                <li Style='height:25px;padding-top:7%;'>Precio: $". $Datos[$i]['Precio'] ." </li> <br/> 
                <li Style='height:25px;'><p style='float: right;'>". $Datos[$i]['Tienda'] ."</p> </li>
              </ul>";
      }
    }
?>