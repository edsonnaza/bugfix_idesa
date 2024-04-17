# Tarea 2: Bugfix para Proceso de Selección

Para avanzar con tu proceso de selección, realiza los siguientes ajustes y correcciones de errores:

## Desafío #1

1. Ejecuta el script DesafioUno.php.
2. Realiza las correcciones necesarias en la función `getClientDebt` para que el JSON devuelva el siguiente formato:
###
```json
{
    "status": true,
    "message": "Tienes Lotes para cobrar",
    "data": {
        "total": 570000,
        "detail": [
            {
                "id": 6,
                "lote": "00148",
                "precio": 190000,
                "clientID": "123456",
                "vencimiento": "2022-12-01"
            },
            {
                "id": 7,
                "lote": "00148",
                "precio": 190000,
                "clientID": "123456",
                "vencimiento": "2023-01-01"
            },
            {
                "id": 8,
                "lote": "00148",
                "precio": 190000,
                "clientID": "123456",
                "vencimiento": "2023-02-01"
            }
        ]
    }
}

```

## Desafío #2
1. Ejecuta el script DesafiaDos.php.
2. Realiza las correcciones necesarias en las funciones retriveLotes y getLotes para que el JSON devuelva el siguiente formato:
###
```json
[ { "id": 4, "lote": "00148", "precio": 130000, "clientID": 123456, "vencimiento": "2022-10-01" },
{ "id": 5, "lote": "00148", "precio": 145000, "clientID": 123456, "vencimiento": null },
{ "id": 6, "lote": "00148", "precio": 190000, "clientID": 123456, "vencimiento": "2022-12-01" },
{ "id": 7, "lote": "00148", "precio": 190000, "clientID": 123456, "vencimiento": "2023-01-01" },
{ "id": 8, "lote": "00148", "precio": 190000, "clientID": 123456, "vencimiento": "2023-02-01" } ]
```

## Desafio #3
Realiza un Servicio REST que retorne todos los lotes datos de un lote segun el id enviado como parametro, utilizando la base idesa.db del Archivo Database.php

## INSTRUCCIONES
 - Para consumir se debe clonar el siguiente repositorio:
`git clone git@github.com:edsonnaza/bugfix_idesa.git`
###
1. Instalar las depencias con: `composer install`
2. Ejecutar el comando: `php -S localhost:8181 -t public public/index.php`
3. Si todo corre bien: get Desafio UNO y get Desafio Dos - LOTES, estan listos para realizar las peticiones al servidor.

##
Ing. Edson Sanchez

`edsonnaza@gmail.com`

