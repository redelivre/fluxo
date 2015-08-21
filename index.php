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
					<header class="pane__header">
						<h2 class="pane__title">Tecnologias sociais para uma sociedade em rede</h2>
						<p class="lead">A #redelivre é uma articulação entre pessoas e coletivos, hackers e quilombolas, índios e artistas com o objetivo de quebrar o paradigma de que desenvolvimento de software é coisa para especialistas, e ousando conectar estes diversos atores da sociedade para construir coletivamente soluções digitais de alta demanda social.</p>
					</header>
				</div>
			</div>
		</section>

		<section class="pane pane--network">
			<div class="row">
				<div class="columns">
					<header class="pane__header">
						<h2 class="text-center pane__title">O impacto da rede</h2>
						<p class="lead text-center">Campanhas, iniciativas sociais e culturais, projetos e pessoas. No Brasil e na América Latina</p>
					</header>
					<ul class="small-block-grid-2 medium-block-grid-4">
						<li class="network__item block__item">
							<span class="network__number">7</span>
							<span class="network__text">países</span>
						</li>
						<li class="network__item block__item">
							<span class="network__number">40</span>
							<span class="network__text">cidades</span>
						</li>
						<li class="network__item block__item">
							<span class="network__number">280</span>
							<span class="network__text">projetos</span>
						</li>
						<li class="network__item block__item">
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
					<header class="pane__header">
						<h2 class="text-center pane__title">Serviços desenvolvidos</h2>
						<p class="lead text-center">Tecnologias sociais para uma sociedade em rede</p>
					</header>
						<div class="row">
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Websites</h3>
									<p class="service__description block__description">Crie, desenvolva e compartilhe suas iniciativas através de um website ou blog</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Envio de email e SMS</h3>
									<p class="service__description">Envie de forma rápida e fácil emails ou mensagens de celular para seus contatos</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Participação social</h3>
									<p class="service__description block__description">Utilize ferramentas para tomada de decisão coletiva, consultas públicas e metodologias de colaboração</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Financiamento online</h3>
									<p class="service__description block__description">Financie coletivamente o sua organização ou projeto através do seu próprio site</p>
								</div>
							</div>
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Mapas colaborativos</h3>
									<p class="service__description block__description">Crie facilmente mapas colaborativos para sua rede, projetos ou qualquer iniciativa</p>
								</div>
							</div>
							
							<div class="medium-4 columns">
								<div class="service__item block__item">
									<h3 class="service__title block__title">Formação</h3>
									<p class="service__description">Participe das atividades de formação práticas e teóricas sobre softwares e metodologias livres</p>
								</div>
							</div>
						</div>
				</div>
			</div>
		</section>
		<section class="pane pane--development">
			<div class="row">
				<div class="columns">
					<header class="pane__header">
						<h2 class="text-center pane__title">Desenvolvimento em rede</h2>
						<p class="lead text-center">Diagnosticar e sistematizar demandas, especificar tecnologias, definir prioridades, desenvolver, testar e implementar soluções de forma aberta e colaborativa, disponibilizando softwares livres que fortalecam movimentos e organizações culturais e sociais</p>
					</header>

					<div class="row">
						<div class="medium-4 columns">
							<div class="development__item block__item">
								<h3 class="development__title block__title">Abertura</h3>
								<p class="development__description">Todas as tecnologias são desenvolvidas integralmente em ambiente aberto e colaborativo, usando o <a href="https://github.com/redelivre">GitHub</a>. Com uma comunidade com mais de 10 milhões de pessoas e 25 milhões de projetos, o GitHub permite hospedar, criar e contribuir com ferramentas de código aberto.</p>
							</div>
						</div>
						<div class="medium-4 columns">
							<div class="development__item block__item">
								<h3 class="development__title block__title">Liberdade</h3>
								<p class="development__description block__description">Os projetos da #redelivre estão disponíveis para adaptação, cópia e uso indiscriminado, e em cada um deles é possível informar erros, fazer perguntas, dar sugestões e discutir futuras funcionalidades. Desenvolvedores podem enviar melhorias de código que, depois de avaliadas pela comunidade, podem se tornar parte daquele projeto.</p>
							</div>
						</div>
						<div class="medium-4 columns">
							<div class="development__item block__item">
								<h3 class="development__title block__title">Comunicação</h3>
								<p class="development__description block__description">A #redelivre também utiliza o <a href="http://gitter.im">Gitter</a>, uma ferramenta de conversa em tempo real integrada ao GitHub, como canal de discussão sobre questões de desenvolvimento. Cada projeto pode ter seu canal de comunicação para trocas de ideias específicas.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="pane pane--funding">
			<div class="row">
				<div class="columns">
					<header class="pane__header">
						<h2 class="text-center pane__title">Financiamento</h2>
						<p class="lead text-center">A redelivre é mantida por aqueles que querem sua existência</p>
					</header>
					<p>Toda tecnologia desenvolvida é livre e gratuita. As pessoas e as organizações que possuem condição de colaborar com os custos o fazem para que aquelas que não tem estrutura financeira tenham também a oportunidade de usar as tecnologias criadas. Hoje são mais de <strong>40 financiadores</strong>. É assim que a redelivre evolui.</p>
				</div>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
