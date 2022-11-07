# api_rest_php
api rest con php sin framework, con los 4 metodos principales, con mysql
# Instrucciones para el uso del apirest, primero se general el token y apartir de ese token generado se pueden usar los metodos, post, put, delete
# Api php + mysql
# Auth - login
# POST /auth
{
"usuario" :"", -> REQUERIDO
"password": "" -> REQUERIDO
}
# Pacientes
GET /pacientes?page=$numeroPagina
GET /pacientes?id=$idPaciente
POST /pacientes
{
"nombre" : "", -> REQUERIDO
"dni" : "", -> REQUERIDO
"correo":"", -> REQUERIDO
"codigoPostal" :"",
"genero" : "",
"telefono" : "",
"fechaNacimiento" : "",
"token" : "" -> REQUERIDO
}
# PUT /pacientes
{
"nombre" : "",
"dni" : "",
"correo":"",
"codigoPostal" :"",
"genero" : "",
"telefono" : "",
"fechaNacimiento" : "",
"token" : "" , -> REQUERIDO
"pacienteId" : "" -> REQUERIDO
}
# DELETE /pacientes
{
"token" : "", -> REQUERIDO
"pacienteId" : "" -> REQUERIDO
}
