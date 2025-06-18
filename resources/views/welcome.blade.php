<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sysdesk Help</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg,rgb(95, 119, 228) 0%,rgb(18, 53, 209) 50%,rgb(147, 204, 251) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Overlay mais suave para melhor contraste */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(-45deg, 
                rgba(102, 126, 234, 0.2), 
                rgba(118, 75, 162, 0.2), 
                rgba(240, 147, 251, 0.2), 
                rgba(245, 87, 108, 0.2));
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            z-index: 0;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Partículas mais sutis */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 8s linear infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 8s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 1s; animation-duration: 10s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 2s; animation-duration: 7s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 3s; animation-duration: 9s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 4s; animation-duration: 11s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; animation-duration: 8s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 6s; animation-duration: 10s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 7s; animation-duration: 9s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 8s; animation-duration: 7s; }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Container principal */
        .main-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar com melhor contraste - REMOVIDA */

        /* Conteúdo principal */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            min-height: 100vh;
        }

        .hero-content {
            padding: 2rem;
            text-align: left;
        }

        .auth-panel {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            margin: 1rem;
            animation: fadeInUp 1s ease 0.2s both;
            transition: all 0.3s ease;
        }

        .auth-panel:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 35px 70px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.5;
        }

        .hero-card {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            margin: 0 1rem;
            animation: fadeInUp 1s ease;
            transition: all 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 35px 70px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            max-width: 120px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
            transition: all 0.3s ease;
            animation: logoFloat 6s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .logo:hover {
            transform: scale(1.1) translateY(-5px);
        }

        .hero-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 2.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.6;
        }

        .feature-icons {
            display: flex;
            justify-content: flex-start;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .feature-icon {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .feature-icon:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .feature-icon i {
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
            display: block;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .feature-icon span {
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .cta-buttons {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .btn-modern {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            max-width: 250px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-outline-modern {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-modern:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover:before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            color: white;
        }

        .btn-outline-modern:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.7);
        }

        /* Informações adicionais com melhor contraste */
        .additional-info {
            margin-top: 2rem; 
            padding-top: 1.5rem; 
            border-top: 1px solid rgba(255,255,255,0.3);
        }

        .additional-info .info-grid {
            display: flex; 
            justify-content: space-around; 
            text-align: center;
        }

        .additional-info i {
            color: white; 
            font-size: 1.2rem; 
            margin-bottom: 0.5rem; 
            display: block;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .additional-info span {
            color: white; 
            font-size: 0.8rem;
            font-weight: 500;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .hero-section .row {
                flex-direction: column-reverse;
            }
            
            .hero-content {
                text-align: center;
                padding: 1rem;
            }
            
            .auth-panel {
                margin: 1rem auto 2rem;
                max-width: 400px;
            }
            
            .feature-icons {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .hero-content, .auth-panel {
                margin: 0.5rem;
                padding: 1.5rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .feature-icons {
                gap: 1rem;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-content, .auth-panel {
                padding: 1.5rem;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .feature-icons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Partículas animadas -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="main-container">


        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container-fluid">
                <div class="row align-items-center min-vh-100">
                    <!-- Coluna do Conteúdo Principal -->
                    <div class="col-lg-7 col-md-6">
                        <div class="hero-content">
                            <!-- Logo -->
                            <div style="background: rgba(255,255,255,0.2); border-radius: 50%; width: 120px; height: 120px; margin: 0 0 2rem; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-headset" style="font-size: 3rem; color: white;"></i>
                            </div>
                            
                            <!-- Título Principal -->
                            <h1 class="hero-title">Bem-vindo ao Sysdesk</h1>
                            
                            <!-- Subtítulo -->
                            <p class="hero-subtitle">
                                Sistema inteligente de helpdesk para gerenciamento eficiente de chamados técnicos.
                                Transforme o suporte da sua empresa com nossa plataforma moderna e intuitiva.
                            </p>

                            <!-- Ícones de Recursos -->
                            <div class="feature-icons">
                                <div class="feature-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                    <span>Chamados</span>
                                </div>
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Relatórios</span>
                                </div>
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                    <span>Equipes</span>
                                </div>
                                <div class="feature-icon">
                                    <i class="fas fa-clock"></i>
                                    <span>24/7</span>
                                </div>
                            </div>

                            <!-- Informações adicionais -->
                            <div class="additional-info">
                                <div class="info-grid">
                                    <div>
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Seguro</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bolt"></i>
                                        <span>Rápido</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-heart"></i>
                                        <span>Confiável</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna do Login/Registro -->
                    <div class="col-lg-5 col-md-6">
                        <div class="auth-panel">
                            <div class="auth-header">
                                <h2 class="auth-title">
                                    <i class="fas fa-rocket me-2"></i>
                                    Comece Agora
                                </h2>
                                <p class="auth-subtitle">
                                    Acesse sua conta ou crie uma nova para começar a usar nosso sistema de helpdesk.
                                </p>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="cta-buttons">
                                <a href="{{ route('login') }}" class="btn-modern btn-primary-modern">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Entrar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animações e interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Efeito parallax suave no scroll
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.hero-card');
                const speed = scrolled * 0.5;
                
                if (parallax) {
                    parallax.style.transform = `translateY(${speed}px)`;
                }
            });

            // Animação de entrada dos elementos
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observar elementos para animação
            document.querySelectorAll('.feature-icon').forEach(icon => {
                icon.style.opacity = '0';
                icon.style.transform = 'translateY(30px)';
                icon.style.transition = 'all 0.6s ease';
                observer.observe(icon);
            });

            // Efeito de hover na navbar - REMOVIDO (navbar removida)
        });
    </script>
</body>
</html>