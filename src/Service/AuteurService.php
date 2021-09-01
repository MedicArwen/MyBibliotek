<?php
namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Auteur;

class AuteurService
{
    private $_entityManager;
    public function __construct(EntityManagerInterface $pEm)
    {
       $this->_entityManager = $pEm ;
    }
    public function list()
    {
        return $this->_entityManager->getRepository(Auteur::class)->findAll();
    }
    public function create($pAuteur)
    {
        $this->_entityManager->persist($pAuteur);
        $this->_entityManager->flush();
    }
    public function update($pAuteur)
    {
        $auteur = $pAuteur;
        $this->_entityManager->flush();
    }
    public function getAuteur($pId)
    {
        return $this->_entityManager->getRepository(Auteur::class)->find($pId);
    }
    public function removeAuteur($pId)
    {
        $auteur = $this->getAuteur($pId);
        if (isset($auteur))
            {
                $this->_entityManager->remove($auteur);
                $this->_entityManager->flush();
            }
    }
}
