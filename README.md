# Training Behat

## Learn Behat

Behat est un outil de test basé sur l'approche BDD.

### Exercice 1 : Tester notre classe Math.php

Behat permet de tester des fonctionnalités appelées `feature`.

Celles-ci sont écrites dans un langage lisible par l'humain (le language `Gerkin`) disposées dans des fichiers `.feature` :

Créer un dossier `features` à la racine du projet ainsi qu'un fichier Math.feature à l'intérieur :

```
Feature: Math
    In order to calculate nunbers
    As anybody
    I need to provide results
```

Une feature représente une fonctionnalité (Use case ou cas d'utilisation).
Un fichier `.feature` devrait contenir une feature et plusieurs test case (case de tests) appelés `Scenario` avec Behat.
 
```
  Scenario: Add two numbers
    When I add 50 to 25
    Then I should get 75
```

Si vous exécuter Behat `.bin/behat` dès maintenant avec ce premier scénario vous vous retrouverez avec l'erreur suivante :

```error
`FeatureContext` context class not found and can not be used.
```

Vous devez donc commencer par définir un context d'exécution. 
Ce dernier se trouve par défaut dans le répertoire `features/boostrap` :

```php
<?php

use Behat\Behat\Context\Context;
use Training\Math;

class FeatureContext implements Context
{
    private $math;
    private $result;

    public function __construct()
    {
        $this->math = new Math();
    }


    /**
     * @When /^I add (\d+) to (\d+)$/
     */
    public function iHaveTheNumberAndTheNumber(float $a, float $b)
    {
        $this->result = $this->math->sum($a, $b);
    }

    /**
    * @Then /^I should get (\d+)$/
    */
    public function iShouldGet($sum)
    {
        if ($this->result != $sum) {
            throw new Exception("Actual sum: ".$this->result);
        }
    }
}

```

Faire la même chose pour la soustraction, la multiplication et la division



