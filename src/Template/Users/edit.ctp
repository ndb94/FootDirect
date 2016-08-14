<div class="users form large-9 medium-8 columns content">
    <div class="panel panel-default">
      <div class="panel-body text-center">
        <h4>Vos coordonnées</h4>
        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'delete/'.$userData['id']], 'id'=> 'formSupprimerCompte', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                                        <fieldset>
                                            <button type="submit" class="btn btn-danger" >Supprimer mon compte&nbsp;
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                        </fieldset>
                                    </form>
      </div>
    </div>
<?php echo $this->Form->create($user, ['id'=> 'formUpdate', 'type' => 'post', 'class' => "form-horizontal"]); ?>
                            <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nom">Nom :</label>  
                                <div class="col-md-4">
                                    <input id="nom" name="nom" placeholder="Votre nom" class="form-control input-md" maxlength="50" required="required" type="text" value="<?= $user['nom']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="prenom">Prénom :</label>  
                                <div class="col-md-4">
                                    <input value="<?= $user['prenom']?>" id="prenom" name="prenom" placeholder="Votre prénom" class="form-control input-md" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="mail">Adresse email :</label>  
                                <div class="col-md-5">
                                    <div class="verifMail">
                                        <input value="<?= $user['mail']?>" id="mail" name="mail" placeholder="Votre adresse email" class="form-control input-md" required="required" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="login">Username :</label>  
                                <div class="col-md-4">
                                    <div class="verifLogin">
                                        <input value="<?= $user['username']?>" id="username" name="username" placeholder="Choisissez un login" class="form-control input-md" required="required" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Mot de passe :</label>
                                <div class="col-md-5">
                                    <div class="verifPassword">
                                        <input value="<?= $user['password']?>" id="password" name="password" placeholder="Choisissez un mot de passe" class="form-control input-md" required="required" type="password">
                                        <span class="help-block">Minimum 8 caractères</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rue">Rue :</label>  
                                <div class="col-md-4">
                                    <input value="<?= $user['rue']?>" id="rue" name="rue" placeholder="Votre rue" class="form-control input-md" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="numero">Numéro :</label>  
                                <div class="col-md-3">
                                    <input value="<?= $user['numero']?>" id="numero" name="numero" placeholder="Votre numéro" class="form-control input-md" required="required" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="localite">Localité :</label>  
                                <div class="col-md-4">
                                    <input value="<?= $user['localite']?>" id="localite" name="localite" placeholder="Votre localité" class="form-control input-md" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="codepostal">Code Postal :</label>  
                                <div class="col-md-3">
                                    <input value="<?= $user['codepostal']?>" id="codepostal" name="codepostal" placeholder="Votre code postal" class="form-control input-md" required="required" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="pays">Pays :</label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->select('id_pays',$list_pays); ?>
                                </div>
                            </div>
                            <input type='hidden' id='role' name='role' value='client'>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="envoyer"></label>
                                <div class="col-md-8">
                                    <button id="envoyer" name="envoyer" type="submit" class="btn btn-success ">Mettre à jour&nbsp;
                                                        <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            </fieldset>
                        <?php echo $this->Form->end();?> 
                        
</div>

<script>
            $(function(){
                $("#formUpdate").on("submit", function() {
                    var jsLogs = JSON.parse('<?php echo JSON_encode($logs);?>');
                    var jsMails = JSON.parse('<?php echo JSON_encode($mails);?>');
                    var jsLogUser = JSON.parse('<?php echo JSON_encode($userData['username']);?>');
                    var jsMailUser = JSON.parse('<?php echo JSON_encode($userData['mail']);?>');                  
                    //vérification du mot de passe
                    $("div.verifLogin").removeClass("has-error");
                    $("div.verifMail").removeClass("has-error");
                    
                    if($("#password").val().length < 8) {
                        $("div.verifPassword").addClass("has-error");
                        $("div.alert").show("slow").delay(4000).hide("slow");
                        return false;
                    }else{
                        $("div.verifPassword").removeClass("has-error");
                    }             
                    //vérification du login
                    if($("#username").val()!=jsLogUser)
                    {
                        var i=0;
                        var flagLog=0;
                        var cptLog=jsLogs.length;
                        while(i<=cptLog&&flagLog===0){
                            
                            if($("#username").val()==jsLogs[i])
                            {
                                $("div.verifLogin").addClass("has-error");
                                alert('Désolé mais ce login est déjà utilisé.');
                                flagLog=1;
                                return false;
                            }
                            else{
                                i++;
                            }
                            
                        }
                    }
                    
                    //vérification du mail
                    if($("#mail").val()!=jsMailUser)         
                    {
                        var j=0;
                        var flagMail=0;
                        var cptMail=jsMails.length;
                        while(j<=cptMail&&flagMail===0){
                            
                            if($("#mail").val()==jsMails[j])
                            {
                                $("div.verifMail").addClass("has-error");
                                alert('Désolé mais ce mail est déjà associé à un compte.');
                                flagMail=1;
                                return false;
                            }
                            else{
                                j++;
                            }
                            
                        }
                    }

                    alert('Vos coordonnées ont été mises à jour avec succès.');
                    
                });
            });        
        </script>

