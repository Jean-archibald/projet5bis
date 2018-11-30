
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$delete = "";
$userToDelete = "";
$userToDelete =  $userManager->getUserById($id);
$userToDeleteId = $userToDelete->id();
$userToDeleteFamilyName =  $userToDelete->familyName();
$userToDeleteFirstName =  $userToDelete->firstName();
$title = 'Supprimer abonné : ' .$userToDeleteFamilyName . ' ' . $userToDeleteFirstName;

if (isset($_POST['delete']) &&  ($_POST['delete']) == 'oui')
{
    $userManager->delete($userToDeleteId);
    $message = '<p class="messageSuppression">L\'utilisateur a bien été supprimé !<p/>';
}
elseif(isset($_POST['delete']) && ($_POST['delete']) == 'non')
{
    $message = '<p class="messageValidation">L\'utilisateur est toujours inscrit !<p/>'; 
}

?>
<form action="<?=$url?>.php" method="post" class="deleteUser">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
            if (!isset($message))
            {
        ?>
        <p class="infoListe">Veuillez confirmer la suppression de  <?= $userToDeleteFamilyName ?> <?= $userToDeleteFirstName ?> ? :
        </br> 
        <input type="radio" name="delete" id="delete" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="delete" id="delete" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Supprimer l'abonné" name="Supprimer l'abonné" />
        <?php
            }
        ?>
    </p>
</form>




<?php 
$deleteUserContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/deleteUserView.php';
?>