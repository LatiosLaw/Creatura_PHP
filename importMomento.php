<?php

require_once("./clases/creatura.php");
require_once("./clases/tipo.php");
require_once("./clases/usuario.php");
$controladorCreatura = new Creatura();
$controladorTipo = new Tipo();
$controladorUsuario = new Usuario();

$lista_creaturas = $controladorCreatura->listar_creaturas_ext(15, "SYSTEM");
$usuarios_aleatorios = $controladorUsuario->listar_usuarios_creadores_aleatorios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creatura</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\inicio.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>

<body>



<textarea id="textoArea" name="w3review" rows="4" cols="50">
{
  "implemented": true,
  "name": "submine",
  "nationalPokedexNumber": 6433,
  "primaryType": "water",
"secondaryType": "steel",
  "abilities": [
      "clearbody",
      "h:filter"
  ],
  "baseStats": {
    "hp": 110,
    "attack": 50,
    "defence": 145,
    "special_attack": 80,
    "special_defence": 70,
    "speed": 35
  },
"behaviour": {
    "resting": {
      "canSleep": true,
      "depth": "normal",
	  "times": "night",
	  "willSleepOnBed": false,
      "light": "0-8"
    },
"moving": {
	  "canLook": false,
	  "walk": {
        "canWalk": false,
		"walkSpeed": 0.2,
		"avoidsLand": true
      },
	  "swim": {
              "swimSpeed": 0.3,
              "canSwimInWater": true,
			  "canSwimInLava" : false,
			  "canBreatheUnderwater": true,
			  "canBreatheUnderlava": false,
			  "canWalkOnWater": false,
			  "canWalkOnLava": false,
			  "hurtByLava" : true,
			  "avoidsWater": false
          },
      "fly": {
        "canFly": false,
		"flySpeedHorizontal": 0.3
      }
    }
  },
"features": [],
  "catchRate": 45,
  "maleRatio": 0.25,
  "shoulderMountable": false,
  "forms": [],
  "baseExperienceYield": 440,
  "experienceGroup": "slow",
  "eggCycles": 40,
  "eggGroups": [
      "water_2"
  ],
  "drops": {
    "amount": "3",
    "entries": [
      {
        "item": "minecraft:iron_ingot",
        "quantityRange": "1-6"
      },
      {
        "item": "minecraft:iron_block",
        "quantityRange": "1",
        "percentage": 8
      },
      {
        "item": "minecraft:cod",
        "quantityRange": "1-7"
      }
    ]
  },
  "moves": [
    "1:endure",
    "1:swallow",
    "2:watergun",
    "5:harden",
    "8:headbutt",
    "10:bubblebeam",
    "12:wideguard",
    "15:takedown",
    "22:bodyslam",
    "23:thundershock",
    "25:gearup",
    "26:metalsound",
    "29:aquaring",
    "30:flashcannon",
    "33:heavyslam",
    "35:irontail",
    "37:discharge",
    "40:hydropump",
    "44:slackoff",
    "50:gyroball",
    "60:steelbeam",
    "61:metalburst",
    "62:explosion",
    "65:laserfocus",
    "tm:rest",
    "tm:dive",
    "tm:waterfall",
    "tm:ironhead",
    "tm:thunderwave",
    "tm:voltswitch",
    "tm:strength",
    "tm:reflect",
    "tm:lightscreen",
    "tm:sleeptalk",
    "tm:defog",
    "tm:liquidation",
    "tm:substitute",
    "tm:raindance",
    "tm:taunt",
    "tm:bodypress",
    "tm:counter",
    "tm:scald",
    "tm:surf",
    "tm:earthquake",
    "tm:protect",
    "tm:hiddenpower",
    "tm:terablast",
    "tm:irondefense",
    "tm:spikes",
    "tutor:steelroller"
  ],
  "labels": [
      "custom"
  ],
  "pokedex": [
      "cobblemon.species.submine.desc1",
      "cobblemon.species.submine.desc2"
  ],
  "baseScale": 3.0,
  "hitbox": {
      "width": 1.5,
      "height": 0.9,
      "fixed": false
  },
  "baseFriendship": 50,
  "evYield": {
    "hp": 3,
    "attack": 0,
    "defence": 3,
    "special_attack": 1,
    "special_defence": 0,
    "speed": 0
  },
  "height": 20,
  "weight": 14500
}
</textarea>
<br>

<button type="button" onclick = "magia()" >Confirmar</button>
</body>
</html>

<script>
var tipo1Posta = "-";
var tipo2Posta = "-";
    function magia(){
        var texto = document.getElementById("textoArea").value;
    const objeto = JSON.parse(texto);
    const funcion = "devolverTiposMagia";
            this.tipo1Posta =  objeto.primaryType;
            this.tipo2Posta =  objeto.secondaryType;
            this.transLate();
    var creatura = { };
    fetch("api/apint/devolverTipos.php?tipo1=" +  tipo1Posta + "&tipo2="+  tipo2Posta , {
        method: "GET"
        })
        .then(response => response.json())
        .then(data => {
            console.log("/////////////////////////////////");
            console.log(data);
            console.log("/////////////////////////////////");
            
            creatura = {
            nombre: objeto.name,
            hp: objeto.baseStats.hp,
            atk: objeto.baseStats.attack,
            def: objeto.baseStats.defence,
            sdef: objeto.baseStats.special_defence,
            spe: objeto.baseStats.speed,
            spa: objeto.baseStats.special_attack,
            id_tipo1: data.devolucion.tipo1.id_tipo,
            id_tipo2: data.devolucion.tipo2.id_tipo,
            habPasivas: []
            };
            this.pasivaManagement();
            for(habilidad of objeto.abilities){
                creatura.habPasivas.push(habilidad);
            }
            console.log(creatura);
        });
    }
    function transLate(){
        if (this.tipo1Posta === "fire") {
            this.tipo1Posta = "fuego";
        } else if (this.tipo1Posta === "water") {
            this.tipo1Posta = "agua";
        } else if (this.tipo1Posta === "grass") {
            this.tipo1Posta = "planta";
        } else if (this.tipo1Posta === "electric") {
            this.tipo1Posta = "eléctrico";
        } else if (this.tipo1Posta === "ice") {
            this.tipo1Posta = "hielo";
        } else if (this.tipo1Posta === "fighting") {
            this.tipo1Posta = "lucha";
        } else if (this.tipo1Posta === "poison") {
            this.tipo1Posta = "veneno";
        } else if (this.tipo1Posta === "ground") {
            this.tipo1Posta = "tierra";
        } else if (this.tipo1Posta === "flying") {
            this.tipo1Posta = "volador";
        } else if (this.tipo1Posta === "psychic") {
            this.tipo1Posta = "psíquico";
        } else if (this.tipo1Posta === "bug") {
            this.tipo1Posta = "bicho";
        } else if (this.tipo1Posta === "rock") {
            this.tipo1Posta = "roca";
        } else if (this.tipo1Posta === "ghost") {
            this.tipo1Posta = "fantasma";
        } else if (this.tipo1Posta === "dragon") {
            this.tipo1Posta = "dragón";
        } else if (this.tipo1Posta === "dark") {
            this.tipo1Posta = "siniestro";
        } else if (this.tipo1Posta === "steel") {
            this.tipo1Posta = "acero";
        } else if (this.tipo1Posta === "fairy") {
            this.tipo1Posta = "hada";
        } else if (this.tipo1Posta === "normal") {
            this.tipo1Posta = "normal";
        }

        ///////////////////////////////////////////////////0-8
        if (this.tipo2Posta === "fire") {
            this.tipo2Posta = "fuego";
        } else if (this.tipo2Posta === "water") {
            this.tipo2Posta = "agua";
        } else if (this.tipo2Posta === "grass") {
            this.tipo2Posta = "planta";
        } else if (this.tipo2Posta === "electric") {
            this.tipo2Posta = "eléctrico";
        } else if (this.tipo2Posta === "ice") {
            this.tipo2Posta = "hielo";
        } else if (this.tipo2Posta === "fighting") {
            this.tipo2Posta = "lucha";
        } else if (this.tipo2Posta === "poison") {
            this.tipo2Posta = "veneno";
        } else if (this.tipo2Posta === "ground") {
            this.tipo2Posta = "tierra";
        } else if (this.tipo2Posta === "flying") {
            this.tipo2Posta = "volador";
        } else if (this.tipo2Posta === "psychic") {
            this.tipo2Posta = "psíquico";
        } else if (this.tipo2Posta === "bug") {
            this.tipo2Posta = "bicho";
        } else if (this.tipo2Posta === "rock") {
            this.tipo2Posta = "roca";
        } else if (this.tipo2Posta === "ghost") {
            this.tipo2Posta = "fantasma";
        } else if (this.tipo2Posta === "dragon") {
            this.tipo2Posta = "dragón";
        } else if (this.tipo2Posta === "dark") {
            this.tipo2Posta = "siniestro";
        } else if (this.tipo2Posta === "steel") {
            this.tipo2Posta = "acero";
        } else if (this.tipo2Posta === "fairy") {
            this.tipo2Posta = "hada";
        } else if (this.tipo2Posta === "normal") {
            this.tipo2Posta = "normal";
        }

    }

function pasivaManagement(){
//separar cosas

}
</script>


