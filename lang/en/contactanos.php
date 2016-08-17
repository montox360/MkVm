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
      <h1 class="page__title title" id="page-title">CONTACT US</h1>
      <article>
        <form action="contactanos.php" method="post" accept-charset="utf-8">
          <div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-empresa">
              <label for="edit-submitted-empresa">Company<span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input type="text" id="edit-submitted-empresa" name="Empresa" value="" size="60" maxlength="255" class="form-text required">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-persona-natural-o-persona-contacto">
              <label for="edit-submitted-persona-natural-o-persona-contacto">Contact <span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input type="text" id="edit-submitted-persona-natural-o-persona-contacto" name="persona" value="" size="60" maxlength="255" class="form-text required">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-pagina-web">
              <label for="edit-submitted-pagina-web">Web Site</label>
              <input type="text" id="edit-submitted-pagina-web" name="pagina_web" value="" size="60" maxlength="255" class="form-text">
            </div>
            <div class="form-item webform-component webform-component-textfield" id="webform-component-telefonos">
              <label for="edit-submitted-telefonos">Phones</label>
              <input type="text" id="edit-submitted-telefonos" name="telefonos" value="" size="60" maxlength="255" class="form-text">
            </div>
            <div class="form-item webform-component webform-component-email" id="webform-component-correo-electronico">
              <label for="edit-submitted-correo-electronico">E-mail:<span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <input class="email form-text form-email required" type="email" id="edit-submitted-correo-electronico" name="email" size="60">
            </div>
            <div class="form-item webform-component webform-component-select" id="webform-component-tipo-de-servicio">
              <label for="edit-submitted-tipo-de-servicio">Type of Service<span class="form-required" title="Este campo es obligatorio.">*</span></label>
             <select id="edit-submitted-type-of-service" name="tipo_servicio" class="form-select required"><optgroup label="Trademarks"><option value="Availability_Searches" selected="selected">Availability Searches</option><option value="Trademark_Applications">Trademark Applications</option><option value="Assignment_Merger_and_Change_of_Name">Assignment, Merger and Change of Name</option><option value="Trademark_Licensing">Trademark Licensing</option><option value="Renewals">Renewals</option><option value="Oppositions">Oppositions</option></optgroup><optgroup label="Patents"><option value="p_Availability_Searches">Availability Searches</option><option value="Patent_Applications">Patent Applications</option><option value="p_Assignment_Merger_and_Change_of_Name">Assignment, Merger and Change of Name</option><option value="Patent_Licensing">Patent Licensing</option><option value="Annuity_Payments">Annuity Payments</option></optgroup><optgroup label="Copyright"><option value="Registration">Registration</option></optgroup><optgroup label="Domain Names"><option value="d_Registration">Registration</option><option value="Renewals">Renewals</option></optgroup><optgroup label="Sanitary Registries"><option value="Sanitary_Registries">Sanitary Registries</option></optgroup></select>
            </div>
            <div class="form-item webform-component webform-component-textarea" id="webform-component-comentarios">
              <label for="edit-submitted-comentarios">Comment<span class="form-required" title="Este campo es obligatorio.">*</span></label>
              <div class="form-textarea-wrapper">
                <textarea id="edit-submitted-comentarios" name="comentarios" cols="60" rows="5" class="form-textarea required"></textarea>
              </div>
            </div>
            <div class="form-actions form-wrapper" id="edit-actions"><input type="submit" id="edit-submit" name="op" value="Submit" class="form-submit">
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