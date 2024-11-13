<?= $this->extend('/LandingPage/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<style>
    .youtube-preview-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        /* 16:9 aspect ratio (9 / 16 = 0.5625) */
        height: 0;
        overflow: hidden;
        max-width: 100%;
    }

    .youtube-preview-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>

<!-- [ Header ] -->
<header id="header" class="header vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <small class="text-white">PHILIPPINE STATE COLLEGE OF AERONAUTICS</small>
                    <h1 class="h1-large">Web-Based Research Management Repository System with Data Analytics </h1>
                    <a class="btn-solid-lg page-scroll" href="#objective">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- [ Objective ] -->
<div class="form-1 bg-gray shadow-lg vh-100 d-flex justify-content-center align-items-center" id="objective">
    <div class="container">
        <div class="mb-5">
            <h1>Research Objective</h1>
            <small class="text-muted">Web-Based Research Management Repository System with Data Analytics</small>
        </div>
        <p>
            A Web-Based Research Management Repository System with Data Analytics for the Philippine State College of Aeronautics is a system that manages, preserves, collects, and stores the thesis or research documents. The general objectives of this capstone project are to develop and design a Web-Based Research Management Repository System with Data Analytics for Philippine State College of Aeronautics to offer a centralized platform that enables smooth project management for research while providing users with innovative analytical capabilities and providing a user-friendly experience that makes the system simple and convenient to operate. Additionally, it serves as a tool for submitting capstone/thesis, thereby reducing the stress and time associated with publishing them to physical repositories.
        </p>
    </div>
</div>

<!-- [ Tutorial ] -->
<div class="form-1 bg-gray shadow-lg vh-100 d-flex justify-content-center align-items-center" id="tutorial">
    <div class="container">
        <div class="mb-5">
            <h1>System Tutorial</h1>
            <small class="text-muted">Web-Based Research Management Repository System with Data Analytics</small>
        </div>


        <div class="youtube-preview-wrapper">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/xfddy5Dw_Wg?si=sP9NzfO6J8a28fey" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- [ Team ] -->
<div class="form-1 shadow-lg  d-flex justify-content-center align-items-center" id="team">
    <div class="container">
        <div class="mb-5">
            <h1>Team</h1>
            <h1></h1>
            <small class="text-muted">Web-Based Research Management Repository System with Data Analytics</small>
            <h1>Institute of Computer Studies</h1>  
            <h1></h1>
            <small class="text-muted">Bachelor of Science in Aviation Information Technology</small>
            <h1></h1>
            <small class="text-muted">S.Y 2024-2025</small>

            
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                <div class="card shadow-sm my-5">
                    <div class="card-header  pb-3 text-center">
                        <img src="/landingPageAssets/images/developers/Morales.jpg" class="rounded-circle mx-auto mb-4" style="width: 40%; object-fit: cover; aspect-ratio: 1/1;">
                        <h3>Morales, Joshua Maurice N.</h3>
                        <span><i>Documentation</i></span>
                    </div>

                    <hr class="mt-1">

                    <div class="card-body">
                        <p>
                            In our research project, I’m in charge of documentation. My role involves making sure that everything we do, from brainstorming to building the actual web system, is recorded properly. This includes tracking the progress of the project, writing down technical details, and making sure our final research paper is clear and comprehensive.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header  pb-3 text-center">
                        <img src="/landingPageAssets/images/developers/Binabise.jpg" class="rounded-circle mx-auto mb-4" style="width: 50%; object-fit: cover; aspect-ratio: 1/1;">
                        <h3>Binabise, Joshua E.</h3>
                        <span><i>Lead Programmer</i></span>
                    </div>

                    <hr class="mt-1">

                    <div class="card-body">
                        <p>
                            In our research project, I work closely with the lead programmer to develop a sophisticated web-based system. As the second programmer, my role is to support the technical aspects of the project by ensuring that the code and system architecture are robust, efficient, and aligned with the research objectives.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header  pb-3 text-center">
                        <img src="/landingPageAssets/images/developers/Andres.jpg" class="rounded-circle mx-auto mb-4" style="width: 50%; object-fit: cover; aspect-ratio: 1/1;">
                        <h3>Andres, Wancho Bong A.</h3>
                        <span><i>Programmer</i></span>
                    </div>

                    <hr class="mt-1">

                    <div class="card-body">
                        <p>
                            In our research project, I serve as the lead programmer responsible for developing a web-based system. This role involves not only the technical execution of writing code but also ensuring that the system we create aligns with the project's overall objectives. Our team has focused on addressing a specific problem by designing a user-friendly, scalable, and secure web application.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                <div class="card shadow-sm my-5">
                    <div class="card-header  pb-3 text-center">
                        <img src="/landingPageAssets/images/developers/Flores.jpg" class="rounded-circle mx-auto mb-4" style="width: 40%; object-fit: cover; aspect-ratio: 1/1;">
                        <h3>Flores, Thomsee B.</h3>
                        <span><i>Documentation</i></span>
                    </div>

                    <hr class="mt-1">

                    <div class="card-body">
                        <p>
                            In our research project, I assist with documentation while primarily focusing on the technical aspects of developing the web-based system. My role includes contributing to the documentation process by recording important technical details and helping ensure our progress is properly tracked. I work closely with the lead on documentation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
        <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
        <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
    </symbol>
</svg>

<?= $this->endSection(); ?>