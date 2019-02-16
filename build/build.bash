COMPOSER='build/composer.json' composer dump-autoload
psalm --config='build/psalm.xml'
sassc --precision 10 'web/Static/Main.scss' > 'web/Static/Amalgamation.css'
