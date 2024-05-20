<?php
session_start();

if (!isset($_SESSION["logged"])) {
    header("Location: login.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWS Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            padding-top: 56px;
        }

        .container {
            margin-top: 20px;
        }

        h2 {
            margin-top: 40px;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
        }


        footer {
            background-color: #f8f9fa;
            color: black;
            text-align: left;
            padding: 10px 0;
        }

        #main {
            height: max-content;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">AWS Project</a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class='nav-item'><a id="a_creationEC2" href="#" class='nav-link'>Creazione istanza EC2</a></li>
                    <li class='nav-item'><a id="a_configurationEC2" href="#" class='nav-link'>Configurazione EC2</a></li>
                    <li class='nav-item'><a id="a_usedTechnologies" href="#" class='nav-link'>Tecnologie utilizzate</a></li>
                    <li class='nav-item'><a href="logout.php" href="#" class='nav-link'>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="main">
        <div id="creationEC2" style="margin-top:5rem;">

            <div id="title" class="container">
                <h1>Creazione istanza EC2</h1>
            </div>

            <div class='container'>
                <h2>Accesso alla piattaforma</h2>
                <ul class="list-unstyled"></ul>
                <p>Accedi alla piattaforma <a href="https://awsacademy.instructure.com/login/canvas">Amazon AWS Canvas Academy</a> utilizzando le tue credenziali.
                    Una volta effettuato l'accesso, verrai indirizzato alla pagina dei moduli dell'Academy.
                    Clicca sul link "Modules" situato in basso a sinistra nella sezione "Get Started".</p>
                <img src="images/modules.png" alt="" style="width:70%; height:70%;">
            </div>

            <div class='container'>
                <h2>Launch AWS</h2>
                <ul class="list-unstyled"></ul>
                <p>Nella pagina successiva, clicca sul link "Launch AWS Academy Learner LAB".</p>
                <img src="images/launchAWS.png" alt="pagina" style="width:70%; height:70%;">
            </div>

            <div class='container'>
                <h2>Start AWS</h2>
                <ul class="list-unstyled"></ul>
                <p>Dopo il caricamento della pagina, clicca sul pulsante "Start".
                    Attendi l'avvio del laboratorio e successivamente clicca su "AWS" per accedere alla console AWS.</p>
                <img src="images/launchLab.png" alt="pagina" style="width:70%; height:70%;">
            </div>

            <div class='container'>
                <h2>Crea una soluzione</h2>
                <ul class="list-unstyled"></ul>
                <p>Nella pagina della console AWS, vai alla sezione "Crea una soluzione" e seleziona "Crea una macchina virtuale".</p>
                <img src="images/EC2.png" alt="" style="width:70%; height:70%;">

                <br><br>

                <p>Nella pagina di creazione della macchina virtuale, configura i seguenti parametri:</p>
                <ul>
                    <li>Nome: Assegna un nome all'istanza.</li>

                    <li>Sistema Operativo: Seleziona Ubuntu come sistema operativo.</li>

                    <li>Coppia di Chiavi: Crea una coppia di chiavi per la connessione tramite OpenSSH o PuTTY.</li>

                    <li>Regole di Accesso: Imposta le regole di accesso necessarie.</li>

                </ul>

                <p>Dopo aver completato la configurazione, clicca su "Avvia istanza".</p>
            </div>

            <div class='container'>
                <h2>Protocolli di sicurezza</h2>
                <ul class="list-unstyled"></ul>
                <p>Accedi al pannello di controllo EC2.
                    Clicca su "Istanze (in esecuzione)" e seleziona l'istanza appena creata.
                    Vai alla sezione "Sicurezza" e aggiungi le regole mancanti per completare la configurazione della sicurezza.</p>
                <img src="images/securityProtocol.png" alt="" style="width:70%; height:70%;">
            </div>

        </div>

        <div id="configurationEC2" style="display:none; margin-top:5rem;">

            <div class="container">
                <h1>Configurazione EC2</h1>
                <h2>Installazione Docker</h2>
                <p>Di seguito riporto i comandi che ho utilizzato per aggiornare le repositories di apt:</p>
                <pre>
            <code>sudo apt-get update
sudo apt-get install -y ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

echo \
"deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
$(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update</code>
        </pre>
                <p>Grazie ai seguenti comandi sono riuscito ad installare effettivamente docker e docker-compose:</p>
                <pre>
            <code class="language-bash">sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin</code>
        </pre>
            </div>

            <div class="container">
                <h2>Generazione di Certificati SSL self-signed</h2>
                <p>Utilizzando la suite openssl ho generato sia il certificato che il file chiave:</p>
                <pre>
            <code class="language-bash">openssl req -nodes -new -x509 -keyout progetto/keys/ssl-cert-snakeoil.key -out progetto/keys/ssl-cert-snakeoil.pem</code>
        </pre>
            </div>

            <div class='container'>
                <h2>Dockerfile</h2>
                <p>Generazione di un file per la configurazione di un'immagine modificata di php:8.2-apache per permettere l'uso di mysqli, di HTTPS e del redirect automatico da HTTP a HTTPS.</p>
                <pre>
            <code>FROM php:8.2-apache

COPY ./public-html/ /var/www/html
COPY ./keys/ssl-cert-snakeoil.key /etc/ssl/private
COPY ./keys/ssl-cert-snakeoil.pem /etc/ssl/certs

RUN sed -i '/<\/VirtualHost>/ i RewriteEngine On\nRewriteCond %{HTTPS} off\nRewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
RUN a2enmod ssl
RUN a2ensite default-ssl

RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli</code>
        </pre>
            </div>

            <div class='container'>
                <h2>compose.yaml</h2>
                <p>Il file compose.yaml viene usato da Docker come configurazione nell'avviamento e nel mantenimento di applicazioni multi-container.</p>
                <p>Nello specifico questo compose.yaml serve ad inizializzare due container (un web server e un database) connessi fra di loro da una Docker network.</p>
                <p>Inoltre vengono specificate alcune variabili di sistema per il database e la posizione della cartella contenente lo script sql di inizializzazione.</p>
                <pre>
            <code class="language-yaml">services:
    php-app:
        build: progetto
        depends_on:
            - db
        ports:
            - "80:80"
            - "443:443"
        networks:
            - net

    db:
        image: mysql:latest
        environment:
            MYSQL_ROOT_PASSWORD: password
            MYSQL_DATABASE: database
        networks:
            - net
        volumes:
            - "./progetto/sql:/docker-entrypoint-initdb.d"

networks:
    net:</code>
        </pre>
            </div>

            <div class='container'>
                <h2>Avviamento dei container</h2>
                <p>Utilizzando il comando "docker compose" possiamo infine avviare l'applicazione.</p>
                <pre>
            <code>sudo docker compose up -d</code>
        </pre>
            </div>
        </div>

        <div id="usedTechnologies" style="display:none; margin-top:5rem; margin-bottom: 18rem;">
            <div class='container'>
                <h2>Tecnologie utilizzate</h2>
                <ul class="list-unstyled">
                    <li>
                        <h5>Docker: </h5>
                        <p>Piattaforma di containerizzazione che semplifica lo sviluppo, la distribuzione e la gestione delle applicazioni.</p>
                    </li>
                    <li>
                        <h5>Dockerfile: </h5>
                        <p>Un file di testo con istruzioni per creare un'immagine Docker</p>
                    </li>
                    <li>
                        <h5>Docker Compose: </h5>
                        <p>Semplifica la gestione di applicazioni multi-container.</p>
                    </li>
                    <li>
                        <h5>Docker Networks: </h5>
                        <p>Permettono ai container di comunicare in modo sicuro e isolato. Le ho usate per creare una rete privata in cui i container scambiano dati</p>
                    </li>
                    <li>
                        <h5>PHP: </h5>
                        <p>Linguaggio di programmazione utilizzato per lo sviluppo di pagine web dinamiche.</p>
                    </li>
                    <li>
                        <h5>Apache: </h5>
                        <p>Server web open source ampiamente adottato per la distribuzione di siti e applicazioni web dinamiche.</p>
                    </li>
                    <li>
                        <h5>Bootstrap</h5>
                        <p>Framework front-end ampiamente usato per lo sviluppo di interfacce web responsive e stilisticamente gradevoli.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <footer style="margin-top:5rem;">
        <div class='container'>
            <p>&copy; Nicolò Fiore</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('a_creationEC2').addEventListener('click', function(event) {
                event.preventDefault();
                var div_creationEC2 = document.getElementById('creationEC2');
                var div_configurationEC2 = document.getElementById('configurationEC2');
                var div_usedTechnologies = document.getElementById('usedTechnologies');

                div_creationEC2.style.display = 'block';
                div_configurationEC2.style.display = 'none';
                div_usedTechnologies.style.display = 'none';
            });
            document.getElementById('a_configurationEC2').addEventListener('click', function(event) {
                event.preventDefault();
                var div_creationEC2 = document.getElementById('creationEC2');
                var div_configurationEC2 = document.getElementById('configurationEC2');
                var div_usedTechnologies = document.getElementById('usedTechnologies');

                div_creationEC2.style.display = 'none';
                div_configurationEC2.style.display = 'block';
                div_usedTechnologies.style.display = 'none';
            });
            document.getElementById('a_usedTechnologies').addEventListener('click', function(event) {
                event.preventDefault();
                var div_creationEC2 = document.getElementById('creationEC2');
                var div_configurationEC2 = document.getElementById('configurationEC2');
                var div_usedTechnologies = document.getElementById('usedTechnologies');

                div_creationEC2.style.display = 'none';
                div_configurationEC2.style.display = 'none';
                div_usedTechnologies.style.display = 'block';
            });
        });
    </script>
</body>

</html>