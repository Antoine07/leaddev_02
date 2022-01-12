# Titanic

Récupérez les données du Titanic dans le dossier Data du Challenge.

Les données dans le dossier Data, vous avez un fichier titanic.csv structuré comme suit, attention certaines informations sont manquantes. Notez que pour savoir que l'on a survécu sur le Titanic on a Survived : 0 ou 1 et que la classe Pclass est notée respectivement par ordre de prix décroissant 1, 2, 3.

```txt
PassengerId,Survived,Pclass,Name,Sex,Age,SibSp,Parch,Ticket,Fare,Cabin,Embarked
1,0,3,"Braund, Mr. Owen Harris",male,22,1,0,A/5 21171,7.25,,S
...
```

## 1. analyse des données

En utilisant la notion de générateur, calculer les :

1. La proportion de personne qui ont survécu dans le Titanic.

2. La proportion de personne qui ont survécu dans le Titanic sachant que l'on est une femme ou un homme.

3. La proportion de personne qui ont survécu dans le Titanic sachant que l'on est une femme ou un homme selon sa classe sur le bateau.


## 2. Observer

1. Créez une classe Passager qui sera observé par un Observer Chance et qui notifiera la chance que cette personne a de survivre sur le Titanic selon qu'elle est une femme ou un homme.

2. Créez un autre Observer qui aura une meilleur granularité et qui donnera la chance de survi selon que l'on est un homme et que l'on est dans une classe donnée, même chose pour les femmes.
