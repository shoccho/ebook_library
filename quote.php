<div class="row mt-5">
<figure class="text-center">
  <blockquote class="blockquote">
    <p id="quote"></p>
  </blockquote>
  <figcaption class="blockquote-footer" id="auth">
    <cite title="Source Title"></cite>
  </figcaption>
</figure>
<script src="quotes.js"></script>
<script>
    window.onload = function (){
     
        var quote_p = document.getElementById("quote");
        var auth_p = document.getElementById("auth");
     
        var r = Math.floor(Math.random()*(quotes.length));

        if (quote_p!=null){
            quote_p.innerHTML=quotes[r]["text"];
        }
        if (auth_p!=null){
            auth_p.innerHTML=quotes[r]["author"];
        }
    }
</script>
</div>