<?php


namespace App\Http\Repository\Interfaces;


interface PostInterface
{
    public function getPostBySlug($slug);
    public function getComments($post);
    public function getCategory($post);
}