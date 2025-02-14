<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

$current_page = 'index';  // Set the current page for active link
$clubs = getClubs($conn);
$events = getUpcomingEvents($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>


<main>
<?php include('../includes/includes-header.php'); ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content" style="margin-top: 150px;">
            <h1>Transformez Votre Avenir Aujourd'hui</h1>
            <p>Rejoignez notre plateforme et boostez votre parcours universitaire avec des opportunités uniques.</p>
            <?php if (!isLoggedIn()): ?>
                <a href="inscription.php" class="btn btn-primary">Inscrivez-vous dès maintenant</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Clubs and Events Section -->
    <section class="features">
        <div class="feature">
            <div class="feature-icon">
                <img src="../assets/image/imagesclubs.png" alt="Clubs" class="feature-img">
            </div>
            <h3>Clubs</h3>
            <p>Rejoignez une variété de clubs et développez vos compétences tout en rencontrant de nouvelles personnes.</p>
            <a href="clubs.php" class="btn btn-secondary">Voir les clubs</a>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="../assets/image/imagesevenements.png" alt="Événements" class="feature-img">
            </div>
            <h3>Événements</h3>
            <p>Participez à des événements inspirants et à des conférences qui élargiront votre horizon.</p>
            <a href="evenements.php" class="btn btn-secondary">Voir les événements</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h2 class="section-title">Nos Services Premium</h2>
        <div class="service-cards">
            <div class="service-card">
                <div class="icon-container">
                    <img src="../assets/image/Accompagnementpersonnalisé.jpg" alt="Service 1" class="service-icon">
                </div>
                <h3>Accompagnement personnalisé</h3>
                <p>Nous offrons un accompagnement adapté pour chaque étudiant afin de maximiser leur réussite.</p>
            </div>

            <div class="service-card">
                <div class="icon-container">
                    <img src="../assets/image/Formationcontinue.jpg" alt="Service 2" class="service-icon">
                </div>
                <h3>Formation continue</h3>
                <p>Nos formations et workshops sont conçus pour vous aider à progresser dans votre domaine d’étude.</p>
            </div>

            <div class="service-card">
                <div class="icon-container">
                    <img src="../assets/image/Événementsexclusifs.jpg" alt="Service 3" class="service-icon">
                </div>
                <h3>Événements exclusifs</h3>
                <p>Accédez à des événements réservés à notre communauté et connectez-vous avec des experts.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2 class="section-title">Témoignages<styles justify-content:center></styles><h2>
        <div class="testimonial-cards">
            <div class="testimonial-card">
                <p>"Cette plateforme a totalement transformé ma vie universitaire. Grâce aux clubs et aux événements, j'ai trouvé ma passion !"</p>
                <h4>Jean Dupont</h4>
                <p>Étudiant en Informatique</p>
            </div>

            <div class="testimonial-card">
                <p>"L'accompagnement personnalisé m'a permis de mieux m'organiser et de réussir mes projets de fin d'année."</p>
                <h4>Marie Lefevre</h4>
                <p>Étudiante en Design</p>
            </div>

            <div class="testimonial-card">
                <p>"Les événements sont non seulement intéressants, mais aussi une excellente occasion de réseauter et de rencontrer des professionnels."</p>
                <h4>Paul Martin</h4>
                <p>Étudiant en Marketing</p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <h2 class="section-title">FAQ</h2>
        <div class="faq-accordion">
            <div class="faq-item">
                <button class="faq-question">Comment puis-je rejoindre un club ?</button>
                <div class="faq-answer">
                    <p>Il vous suffit de vous inscrire, puis de naviguer dans la section "Clubs" pour découvrir ceux qui vous intéressent.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Quels types d'événements sont organisés ?</button>
                <div class="faq-answer">
                    <p>Nous organisons des événements académiques, professionnels et sociaux pour enrichir votre expérience universitaire.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Est-ce que les événements sont gratuits ?</button>
                <div class="faq-answer">
                    <p>Certains événements sont gratuits, tandis que d'autres nécessitent une inscription payante.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <h2 class="section-title">Nos Partenaires</h2>
        <div class="partner-logos">
            <img src="../assets/image/perssone1.jpg" alt="Partner 1" class="partner-logo">
            <img src="../assets/image/perssone2.jpg" alt="Partner 2" class="partner-logo">
            <img src="../assets/image/perssone3.jpg" alt="Partner 3" class="partner-logo">
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta">
        <div class="cta-content">
            <h2>Prêt à rejoindre une communauté dynamique ?</h2>
            <p>Ne manquez pas les opportunités de croissance personnelle et professionnelle. Rejoignez-nous maintenant !</p>
            <a href="inscription.php" class="btn btn-primary">Rejoindre maintenant</a>
        </div>
    </section>

</main>

<?php include('../includes/includes-footer.php'); ?>

<script src="script.js"></script>
</body>
</html>
