<!DOCTYPE HTML>

<!--

File: login_register.php
Author: Branislav Bajic

-->
<style>
    section{
        box-sizing:border-box;
        display:block;
        width:100%;
        padding: 5% 5%;
    }
    row{
        box-sizing:border-box;
        display:inline-block;
        width: 50%;
        vertical-align: top;
    }
    .forma_termin{
	font-size: 1.5vw;
        color: white;
    }

    .forma_termin input{
            width:100%;
            padding: 0.5% 1%;
            margin-bottom: 2%;
            box-sizing: border-box;
            font-size: 1vw;
    }

    .forma_termin .button{
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            padding: 2%;
            font-size: 1vw;
    }

    .forma_termin .button:hover{
            cursor: pointer;
    }
    #2 h5{
        margin: 0;
        padding: 0;
    }
</style>
<section>
    <row style='width:40%;'>
        <form class="forma_termin" action="<?php echo $_SERVER['PHP_SELF'].'/?controller=gost&action=login';?>" method="post">
            <table>
                <h2>Imaš nalog?</h2>
                <h4 style='color:red;'><?php if(isset($_POST['poruka'])) echo $_POST['poruka']; ?></h3>
                <tr>
                    <td>Korisnicko ime:</td>
                    <td>
                        Lozinka:
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="username" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>"/></td>
                    <td><input type="password" name="password"/></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Prijavi se" class="button"/>
                    </td>
                </tr>
                </table>
        </form> 
    </row><!--
    
 --><row style='width:60%;' id="2">
        <form class="forma_termin" action="<?php echo $_SERVER['PHP_SELF'].'/?controller=gost&action=register';?>" method="post">
             <table>
                <h2>Nemaš nalog? Registruj se besplatno i postani deo zajednice TrebaMiIgrac.rs</h2>
                <tr>
                    <td>Korisnicko ime:</td>
                    <td>
                        <input type="text" name="username" value=""/>
                    </td>
                    <td style="color:red">
                        <?php 
                        if(isset($_POST['poruka0'])) echo '*'. $_POST['poruka0']; if(isset($_POST['poruka1'])) echo '*' . $_POST['poruka1'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Lozinka</td>
                    <td>
                        <input type="password" name="password"/>
                    </td>
                    <td style="color:red">
                        <?php
                            if(isset($_POST['poruka2'])) echo '*' . $_POST['poruka2'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Potvrdi lozniku:</td>
                    <td>
                        <input type="password" name="password_validation" value=""/>
                    </td>
                    <td style="color:red">
                        <?php
                            if(isset($_POST['poruka3'])) echo '*' . $_POST['poruka3'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>E-adresa:</td>
                    <td>
                        <input type="text" name="email" value=""/>
                    </td>
                    <td style="color:red">
                        <?php
                            if(isset($_POST['poruka4'])) echo '*' . $_POST['poruka4'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" value="REGISTRUJ SE" class="button"/>
                    </td>
                </tr>
                </table>
        </form>
    </row>
</section>