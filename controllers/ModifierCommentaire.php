<?php

require_once('../models/CommentModel.php');

$modifierCommentaire = new CommentModel();
$modifierCommentaire->updateCommentaire($id);

redirect('../views/article.php');