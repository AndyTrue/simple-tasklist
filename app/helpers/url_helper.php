<?php

//redirect
function redirect($page)
{
    header('Location: ' . URLROOT . '/' .$page);
}