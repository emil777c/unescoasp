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
            <section id="container">
            </section>
			 </main><!-- #main --> 

    <script>
        let projekter;
        const url = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/projekt?per_page=100"



        async function hentData() {
        const respons = await fetch(url);
        projekter = await respons.json();
        console.log(projekter);
       visProjekter();
        }

       function visProjekter() {
         const container = document.querySelector("#container");
        const template = document.querySelector("template");


        projekter.forEach((projekt) => {
    // Tjek hvilket verdensmål projektet har, sammenlign med aktuelt filter eller hvis filter har værdien "alle" så vis alle
      const klon = template.cloneNode(true).content;

      // Tilføjer elementer fra Jason til template
      klon.querySelector(".billede").src = projekt.billede.guid;
      klon.querySelector(".titel").textContent = projekt.title.rendered;
      klon.querySelector(".beskrivelse").textContent = projekt.beskrivelse;
      klon.querySelector(".verdensmaal").textContent = projekt.verdensmaal;
      klon.querySelector("article").addEventListener("click", () => visEnkelProjekter(projekt));

      // Tilføjer variablen klon som child af variablen container
      container.appendChild(klon);
  });
}

         hentData();
    </script>

	</div><!-- #primary -->




<?php
get_footer();
