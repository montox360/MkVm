<!DOCTYPE html>
<html class="js" lang="es" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">
<head>
  <meta charset="utf-8"></meta>
  <title>Montoya, Kociecki & Asociados</title>
  <meta content="width" name="MobileOptimized"></meta>
  <meta content="true" name="HandheldFriendly"></meta>
  <meta content="width=device-width" name="viewport"></meta>
  <meta content="on" http-equiv="cleartype"></meta>
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../../css/style_ppal.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../../css/owl.carousel.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../../css/owl.theme.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" media="screen" />
  <script src="../../js/jquery-1.11.3.min.js"></script>
  <script src="../../js/owl.carousel.min.js"></script>
  <script src="../../js/slider_script.js"></script>
</head>
<body>
<header id="header" class="header" role="banner"> 
<?php
  include 'header.php';
?>
</header>
<?php
  include 'mini-slider.php';
?>
<div id="page">
  <div id="main_contact">
    <div id="content" class="contact_formdiv">
      <h1 class="page__title title" id="page-title">CONTACTANOS</h1>
      <article>
        <form action="contactanos.php" method="post" accept-charset="utf-8">
          <div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-empresa">
              <label for="edit-submitted-empresa">Empresa <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input type="text" id="edit-submitted-empresa" name="Empresa" value="" size="60" maxlength="255" class="form-text required">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-persona-natural-o-persona-contacto">
              <label for="edit-submitted-persona-natural-o-persona-contacto">Persona Natural o Persona Contacto <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input type="text" id="edit-submitted-persona-natural-o-persona-contacto" name="persona" value="" size="60" maxlength="255" class="form-text required">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-pagina-web">
              <label for="edit-submitted-pagina-web">Página Web </label>
              <input type="text" id="edit-submitted-pagina-web" name="pagina_web" value="" size="60" maxlength="255" class="form-text">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-telefonos">
              <label for="edit-submitted-telefonos">Teléfonos </label>
              <input type="text" id="edit-submitted-telefonos" name="telefonos" value="" size="60" maxlength="255" class="form-text">
            </div>
            <div class="form-item webform-component webform-component-email" id="webform-component-correo-electronico">
              <label for="edit-submitted-correo-electronico">Correo Electrónico <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input class="email form-text form-email required" type="email" id="edit-submitted-correo-electronico" name="email" size="60">
            </div>
            <div class="form-item webform-component webform-component-select" id="webform-component-tipo-de-servicio">
              <label for="edit-submitted-tipo-de-servicio">Tipo de Servicio <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <select id="edit-submitted-tipo-de-servicio" name="tipo_servicio" class="form-select required"><optgroup label="Marcas"><option value="m_busqueda_de_antecedentes">Búsqueda de antecedentes</option><option value="solicitud_de_marca">Solicitud de Marca</option><option value="m_cesion_fusion_cambio_de_nombre">Cesión, Fusión y Cambio de Nombre</option><option value="m_licencias_de_uso">Licencias de uso</option><option value="renovaciones ">Renovaciones</option><option value="Oposiciones ">Oposiciones</option></optgroup><optgroup label="Patentes"><option value="p_busqueda_de_antecedentes">Búsqueda de antecedentes</option><option value="solicitud_de_patentes">Solicitud de Patentes</option><option value="p_cesion_fusion_cambio_de_nombre">|Cesión, Fusión y Cambio de Nombre</option><option value="p_licencias_de_uso">Licencias de uso</option><option value="pago_de_anualidades">Pago de Anualidades</option></optgroup><optgroup label="Derechos de Autor"><option value="d_registro">Registro</option></optgroup><optgroup label="Nombres de Dominio"><option value="n_registro">Registro</option><option value="renovacion">Renovación</option></optgroup><optgroup label="Registros Sanitarios"><option value="registros_sanitarios">Registros Sanitarios</option></optgroup></select>
            </div>
            <div class="form-item webform-component webform-component-textarea" id="webform-component-comentarios">
              <label for="edit-submitted-comentarios">Comentarios <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <div class="form-textarea-wrapper">
                <textarea id="edit-submitted-comentarios" name="comentarios" cols="60" rows="5" class="form-textarea required"></textarea>
              </div>
            </div>
            <div class="form-actions form-wrapper" id="edit-actions"><input type="submit" id="edit-submit" name="op" value="Enviar" class="form-submit">
            </div>
          </div>             
        </form>     
      </article>           
    </div>     
  </div>
</div>
<?php
  include 'div-contact.php';
  include 'footer.php';
?>
</body>
</html>