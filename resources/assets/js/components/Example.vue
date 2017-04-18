<template>
	<section>
	</section>
</template>

<script>
  export default {
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  	 }
  }
</script>