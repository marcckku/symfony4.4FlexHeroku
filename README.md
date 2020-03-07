>
------------------------------------------------------------------------------------------------------------------------
Questo Repository contiene la struttura Base Symfony versione 4.4[modo PRODUZIONE] pronta per il Deploy su Heroku.
NB: 
Heroku manuale : https://devcenter.heroku.com/articles/deploying-symfony4#url-rewrites
				[ composer create-project symfony/website-skeleton symfony4-heroku/ ]
				
Struttura aggiornata alla versione SYMFONY 4.4/FLEX come richiesto 
dal Manuale Officiale -> https://symfony.com/doc/4.4/setup/flex.html 
>
------------------------------------------------------------------------------------------------------------------------
Questo Repository contiene la struttura Base Symfony versione 4 pronta per il Deploy su Heroku.

 + NT: Se vuoi farlo da capo allora segue le istruzioni passo a passo (fare come dice la guida).
 + Guida Heroku https://devcenter.heroku.com/articles/deploying-symfony4 cosi ho costruito questa struttura.
 
------------------------------------------------------------------------------------------------------------------------
>

> Contiene 
 -  Struttura Symfony 4
 -  Ho usato Heroku CLI (ti consiglio di usare il promnt [ https://cmder.net/ ] con git incorporato )
 -  [.htaccess] serve per eliminare dal url l'index.php dal percorso/url nel browser. 
 
    > Esempio http://tuo-nomeo-progetto.herokuapp.com/public/test/heroku
    
 -  Aggiunta codice php come approccio sicuro per il router Heroku, nel file index.php di questa struttura.
 
 -  Creazione del file "Procfile" che serve a Heroku per poter trovare la cartella root del tuo progetto.
 
 -  Contiene la possibilità di vedere il log (quando navighi sulla tua app), dal tuo cmd, loggandoti ovviamente
    con [ heroku login ] e dopodichè esegui > [ heroku logs --tail ] per mantenere aperto il flusso di registri
    da Heroku nel tuo terminale(il tuo log remoto).
    
 + Se hai aggiunto un database (esempio: ClearDB) sulla piattaforma Heroku, semplicemente copia l'url DB risultante
     di Heroku e incollalo nel file .env poi da cmder esegui questo commando :
     
     > heroku config:set DATABASE_URL='mysql://username:password@hostname/database_name?reconnect=true'
     
 >    
------------------------------------------------------------------------------------------------------------------------
                                              PULISCI/CLEAR PROJECT SYMFONY4 CACHE ON CMD 
  Ti puo servire dopo ogni modifica del tuo progetto sia in PROD o DEV. Prima del push sulla tua repo su Github o su 
  Heroku direttamente.!!
  
  > ----- Your cache project Symfony localmente
  * php bin/console cache:clear 
  * composer update
  
  > ----- Your cache project Symfony remoto Heroku
  * heroku run "php bin/console cache:clear" 
  
  > ----- Aggiorna la repository Heroku con :
  * git add . 
  * git commit 
  * git push heroku master
  
------------------------------------------------------------------------------------------------------------------------
 >
