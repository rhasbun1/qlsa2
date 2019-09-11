<!DOCTYPE html>
<html lang="en">
	<style>
	.pdfobject-container { height: 40rem; border: 1rem solid rgba(0,0,0,.1); }
	</style>
	<head></head>
	<body>
	  	<div id="example1">
	  	</div>
	</body>
  	<script src="{{ asset('/') }}js/pdfobject.js"></script>
	<script>PDFObject.embed("{{$nombreArchivo}}", "#example1")</script>
</html>