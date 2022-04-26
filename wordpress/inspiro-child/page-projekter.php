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
<style>
    #container {
    /* desktop vises article i et grid med kolloner af 3 - data ligger sig under hinanden*/
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: auto;
    gap: 20px;
  }
  
</style>
    <template>
        <article>
          <img class="billede" src="" alt="" />
          <h3 class="titel"></h3>
          <p class="beskrivelse"></p>
          <p class="videolink"></p>
          <p class="verdensmaal"></p>
          <button>Læs mere</button>
        </article>
      </template>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <nav id="filtrering"><button data-projekt="">Alle</button></nav>
            <section id="container">
            </section>
			 </main><!-- #main --> 

    <script>
        let projekter;
        let categories;
        let filterProjekt = "alle";
        const url = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/projekt?per_page=100";
        const catUrl = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/categories";



        async function hentData() {
        const respons = await fetch(url);
        const catrespons = await fetch(catUrl);
        projekter = await respons.json();
        categories = await catrespons.json();
        console.log(projekter);
       visProjekter();
       opretKnapper();
        }

        function opretKnapper() {
            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${cat.id}">${cat.name}</button>`
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
