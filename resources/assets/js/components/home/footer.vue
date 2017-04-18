<template>
        <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
</template>

<script>
  export default {}
</script>
<style scoped>
	footer.page-footer{
		position: absolute;
	    width: 100%;
	    bottom: 30px;
	    background: #18A15F;
	}
	@media only screen and (max-width: 450px){
		footer.page-footer{
			padding-top: 0!important;
		}
	}
</style>