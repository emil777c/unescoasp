<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro 1.0.0
 * @version 1.0.0
 */

get_header(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
<style>
    @media (min-width: 600px) {
    #container {
    /* desktop vises article i et grid med kolloner af 3 - data ligger sig under hinanden*/
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: auto;
    gap: 20px;
  }
}

#container {
    margin: 30px;
}



  
</style>
<main id="mainn" class="site-main" role="main">
<section class="first_section">
    <div class="section_wrapper">
        <h1>Projekter inde for verdensmålene</h1>
        <p>På siden findes projekter indsendt af danske UNESCO verdensmålsskoler. 
            Projekterne er alle med udgangspunkt i FNs 17 verdensmål og kan bruges som inspiration og motivation
             samt udgøre grundlaget for eksempelvis skoleprojekter, undersøgelser eller lignende.</p>
    </div>

</section>
    <template>
        <article class="first_article">
          <img class="billede" src="" alt="" />
          <h3 class="titel"></h3>
          <p class="beskrivelse"></p>
          <p class="videolink"></p>
          <p class="verdensmaal"></p>
          <button class="readmore">Læs mere</button>
        </article>
      </template>

	<div id="primary" class="content-area">

            <div class="button_wrapper">
            <nav id="filtrering"><button class="alle" data-projekt="">Alle</button></nav>
            </div>
            <section id="container">
            </section>
            
			 </main><!-- #main --> 

    <script>
        let projekter;
        let categories;
        let filterProjekt = "alle";
        const url = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/projekt?per_page=100";
        const catUrl = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/categories?per_page=100";



        async function hentData() {
        const respons = await fetch(url);
        const catrespons = await fetch(catUrl);
        projekter = await respons.json();
        categories = await catrespons.json();
        console.log(projekter);
       visProjekter();
       opretKnapper();
       opretTitel();
        }



        function opretKnapper() {
            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${cat.id}"</button>`
            })
            addEventListenersToButtons();
        }


        function addEventListenersToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm =>{
                elm.addEventListener("click", filtrering);
            })
        };

        function filtrering(){
            filterProjekt = this.dataset.projekt;
            console.log(filterProjekt);

            visProjekter();
        }

       function visProjekter() {
         const container = document.querySelector("#container");
        const template = document.querySelector("template");
        container.innerHTML = "";


        projekter.forEach((projekt) => {
            if ( filterProjekt == "alle" || projekt.categories.includes(parseInt(filterProjekt))) {
        // Tjek hvilket verdensmål projektet har, sammenlign med aktuelt filter eller hvis filter har værdien "alle" så vis alle
                let klon = template.cloneNode(true).content;

                // Tilføjer elementer fra Jason til template
                klon.querySelector(".billede").src = projekt.billede.guid;
                klon.querySelector(".titel").textContent = projekt.title.rendered;
                klon.querySelector(".beskrivelse").textContent = projekt.beskrivelse;
                klon.querySelector(".verdensmaal").textContent = projekt.verdensmaal;
                klon.querySelector("article").addEventListener("click", () => {location.href = projekt.link; })

      // Tilføjer variablen klon som child af variablen container
      container.appendChild(klon);
         }
  })
    }

         hentData();
    </script>

	</div><!-- #primary -->




<?php
get_footer();
