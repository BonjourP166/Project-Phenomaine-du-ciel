<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
  <link rel="stylesheet" href="../styles/css_principale.css">
  <link rel="stylesheet" href="../styles/css_container.css">
  <link rel="stylesheet" href="../styles/css_Banieres.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-container input[type="file"] {
            margin-top: 5px;
        }

        .form-container button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: #4a16b0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #341082;
        }

        .form-container img {
            display: block;
            margin: 10px auto;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4a16b0;
        }

        .success-msg, .error-msg {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .success-msg {
            color: green;
        }

        .error-msg {
            color: red;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>
<div class="form-container">
    <h2>Modifier votre profil</h2>

    <!-- Affichage de l'image actuelle -->
    <?php if (!empty($_SESSION['utilisateur']['image_profil'])): ?>
        <img src="<?= htmlspecialchars($_SESSION['utilisateur']['image_profil']) ?>" alt="Image profil">
    <?php endif; ?>

    <form id="modifier-profil" method="POST" action="../ajax/modifier_profil.php" enctype="multipart/form-data">
        <!-- Token CSRF -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generate_csrf_token()) ?>">

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($_SESSION['utilisateur']['ville'] ?? '') ?>">

        <label for="bio">Bio :</label>
        <textarea id="bio" name="bio" rows="4"><?= htmlspecialchars($_SESSION['utilisateur']['bio'] ?? '') ?></textarea>

        <label for="image_profil">Image de profil :</label>
        <input type="file" id="image_profil" name="image_profil" accept="image/*">

        <button type="submit">Mettre à jour le profil</button>

        <div class="success-msg" id="success-msg"></div>
        <div class="error-msg" id="error-msg"></div>
    </form>
</div>

<script>
    // Optionnel : gestion du formulaire en AJAX
    const form = document.getElementById('modifier-profil');
    const successMsg = document.getElementById('success-msg');
    const errorMsg = document.getElementById('error-msg');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        successMsg.textContent = '';
        errorMsg.textContent = '';

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                successMsg.textContent = result.message;
                // Met à jour l'image si elle a été modifiée
                if(result.profil.image_profil) {
                    const img = document.querySelector('.form-container img');
                    if(img) img.src = result.profil.image_profil + '?' + new Date().getTime();
                    else {
                        const newImg = document.createElement('img');
                        newImg.src = result.profil.image_profil;
                        newImg.alt = "Image profil";
                        document.querySelector('.form-container').insertBefore(newImg, form);
                    }
                }
            } else {
                errorMsg.textContent = result.message;
            }
        } catch (err) {
            errorMsg.textContent = "Une erreur est survenue. Veuillez réessayer.";
        }
    });
</script>


<?php include 'includes/footer.php'; ?>
</body>
</html>