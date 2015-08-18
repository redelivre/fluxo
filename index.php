<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fluxo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<section class="pane pane--intro pane--reverse">
			<div class="row">
				<div class="columns large-7 medium-10 medium-centered large-uncentered">
					<h2 class="pane__title">Tecnologias sociais para uma sociedade em rede</h2>
					<p class="lead">A #redelivre é uma articulação entre pessoas e coletivos, hackers e quilombolas, índios e artistas com o objetivo de quebrar o paradigma de que desenvolvimento de software é coisa para especialistas, e ousando conectar estes diversos atores da sociedade para construir coletivamente soluções digitais de alta demanda social.</p>
				</div>
			</div>
		</section>

		<section class="pane pane--network">
			<div class="row">
				<div class="columns">
					<h2 class="text-center pane__title">O impacto da rede</h2>
					<p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, dolor similique, possimus, harum in debitis iste quos dicta ipsa aliquid sequi. Voluptate ipsam temporibus, eum doloribus earum consequatur. Itaque, nostrum.</p>
					<ul class="small-block-grid-2 medium-block-grid-4">
						<li class="network__item">
							<span class="network__number">7</span>
							<span class="network__text">países</span>
						</li>
						<li class="network__item">
							<span class="network__number">40</span>
							<span class="network__text">cidades</span>
						</li>
						<li class="network__item">
							<span class="network__number">280</span>
							<span class="network__text">projetos</span>
						</li>
						<li class="network__item">
							<span class="network__number">4k</span>
							<span class="network__text">usuários</span>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<section class="pane pane--services">
			<div class="row">
				<div class="columns">
					<h2 class="text-center pane__title">Serviços desenvolvidos</h2>
						<p class="lead text-center">Tecnologias sociais para uma sociedade em rede</p>
						<div class="row">
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Websites</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora illum quas repellat? Debitis, dolor earum quisquam? Sequi reprehenderit quae at esse inventore nam tenetur consequatur, error accusantium! Ullam, rem saepe.</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Participação social</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam enim, magnam voluptates itaque, debitis necessitatibus vero, explicabo distinctio cumque repellat exercitationem dicta laborum corporis excepturi! Cumque quas eaque, perspiciatis minus?</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Plataformas de deliberação online</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam dolorem tempora consectetur illo nostrum, ex cupiditate quos aspernatur earum, minima distinctio dolorum porro inventore officia iure obcaecati a eum totam.</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Comunicação digital</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis eligendi mollitia praesentium quis aut perspiciatis, libero, quam quaerat sapiente laudantium aliquid quod necessitatibus quas doloribus iste ducimus, soluta, amet nemo?</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Envio de email e SMS</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam adipisci eius ea cumque minima recusandae est beatae, voluptates? Earum, incidunt, repellat. Laboriosam nihil vero aspernatur aliquam delectus commodi, id error.</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item">
									<h3 class="service__title">Sistemas de contribuição</h3>
									<p class="service__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero dignissimos eveniet eos animi placeat natus iusto molestias, eius quidem sint tempora cupiditate rerum illum accusamus illo vitae quas, dolor hic!</p>
								</div>
							</div>
						</div>
				</div>
			</div>
		</section>
		<section class="pane pane--development">
			<div class="row">
				<div class="columns">
					<h2 class="text-center pane__title">Desenvolvimento em rede</h2>
					<p class="lead text-center">Diagnosticar e sistematizar demandas, especificar tecnologias, definir prioridades, desenvolver, testar e implementar soluções de forma aberta e colaborativa, disponibilizando softwares livres que fortalecam movimentos e organizações culturais e sociais</p>
				</div>
			</div>
		</section>
		<section class="pane pane--funding">
			<div class="row">
				<div class="columns">
					<h2 class="text-center pane__title">Financiamento</h2>
					<p class="lead text-center">A redelivre é mantida por aqueles que querem sua existência.</p>
					<p>Toda tecnologia da #redelivre é livre e gratuita. A grande maioria das organizações utiliza nossos serviços de forma gratuita por não terem condições de colaborar. No entanto, as organizações que possuem uma estrutura financeira melhor contribuem para que a rede possa seguir avançando. Hoje são mais de <strong>40 organizações</strong> colaborando com os custos.</p>
				</div>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
