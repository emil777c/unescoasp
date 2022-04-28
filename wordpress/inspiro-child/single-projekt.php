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


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
        <article id="singleView">
        <div id=grid>
         <div class=tekst>
        <h3 class="titel"></h3>
          <p class="langbeskrivelse"></p>
            </div>
            <div class="img">
             <img class="billede" src="" alt="" />
            </div>
            </div>
        
          <p class="videolink"></p>
          <p class="verdensmaal"></p>
        </article>
			</main><!-- #main -->

            <script>
        let projekt;
        const url = "https://www.emiltoft.dk/kea/09_CMS/unescoasp/wordpress/wp-json/wp/v2/projekt/"+<?php echo get_the_ID() ?>;



        async function hentData() {
        const respons = await fetch(url);
        projekt = await respons.json();
        console.log(projekt);
       visEnkelProjekter();
        }

        

       function visEnkelProjekter() {
      // Tilføjer elementer fra Jason til template
        document.querySelector(".billede").src = projekt.billede.guid;
        document.querySelector(".titel").textContent = projekt.title.rendered;
        document.querySelector(".langbeskrivelse").textContent = projekt.langbeskrivelse;
        document.querySelector(".verdensmaal").textContent = projekt.verdensmaal;
    }

    hentData();
    </script>

	</div><!-- #primary -->



<?php
get_footer();
