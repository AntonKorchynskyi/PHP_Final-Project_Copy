<div id="home" class="container-md">
    <h1><?= $title ?? "Home" ?></h1>
    <div class="user_info">
        <span><?= $name ?? "User" ?></span>
        <span><?= $email ?? "" ?></span>
    </div>
    <form action="<?= ROOT_PATH ?>/pages/contact-us" method="post" id = "messageForm">
        
        <div class="form-group my-3">
            <label for="message">Your message: </label>
            <textarea form = "messageForm" name="message" id="message" cols="30" rows="10"></textarea>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
