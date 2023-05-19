
<script>
    $(document).ready(function(){
      function fade() {
        $("table:first").fadeIn(1000).fadeOut(1000, fade);
      }
      fade();
    });
</script>

<script>
    $(document).ready(function(){
        function fadeBg() {
        $("body").animate({ backgroundColor: "lightgray" }, 1000)
             .animate({ backgroundColor: "transparent" }, 1000, fadeBg);
        }
        fadeBg();
    });
</script>

