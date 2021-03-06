<?php

session_start();

if($_SESSION["rolId"] == 1){
  echo "<div class='col s12  m12 l6'>
                      <div class='card center medium'>
                          <div class='card-image waves-effect waves-block waves-light' style='height:80%;'>
                              <img class='activator' src='../img/institutionIcon.jpg' style='width:100%;'>
                          </div>
                          <div class='card-content'>
                              <span class='card-title activator grey-text text-darken-4'>Instituciones</span>
                          </div>
                          <div class='card-reveal'>
                              <span class='card-title grey-text text-darken-4' style='width100%;'>Instituciones<i class='material-icons right'>close</i></span>
                                  <div class='opciones-menu'>
                                      <i class='material-icons center medium' >description</i>
                                      <a class='btn waves-effect waves-light circle' type='submit' name='action'  href='Registro.html'>Registro</a>
                                  </div>
                                  <br>
                                  <div class='opciones-menu'>
                                      <i class='material-icons center medium '>pageview</i>
                                      <a class='btn waves-effect waves-light ' type='submit' name='action' href='ConsultaInstituciones.html'>Consulta</a>
                                  </div>
                          </div>
                      </div>
                  </div>";

  echo "<div class='col s12  m12 l6'>
                      <div class='card center medium'>
                          <div class='card-image waves-effect waves-block waves-light' style='height:80%;'>
                              <img class='activator' src='../img/userIcon.png' style='width:100%;'>
                          </div>
                          <div class='card-content'>
                              <span class='card-title activator grey-text text-darken-4'>Usuarios</span>
                          </div>
                          <div class='card-reveal'>
                              <span class='card-title grey-text text-darken-4' style='width100%;'>Usuarios<i class='material-icons right'>close</i></span>
                                  <div class='opciones-menu'>
                                      <i class='material-icons center medium' >description</i>
                                      <a class='btn waves-effect waves-light circle' type='submit' name='action'  href='RegistroUsuario.html'>Registro</a>
                                  </div>
                                  <br>
                                  <div class='opciones-menu'>
                                      <i class='material-icons center medium '>pageview</i>
                                      <a class='btn waves-effect waves-light ' type='submit' name='action' href='ConsultaUsuarios.html'>Consulta</a>
                                  </div>
                          </div>
                      </div>
                  </div>";
}

?>
