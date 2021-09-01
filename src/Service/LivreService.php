<?php
namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Livre;

class LivreService
{
    private $_entityManager;
    public function __construct(EntityManagerInterface $pEm)
    {
       $this->_entityManager = $pEm ;
    }
    public function list()
    {
        return $this->_entityManager->getRepository(Livre::class)->findAll();
    }
    public function create($pLivre)
    {
        $this->_entityManager->persist($pLivre);
        $this->_entityManager->flush();
    }
    public function update($pLivre)
    {
        $livre = $pLivre;
        $this->_entityManager->flush();
    }
    public function getLivre($pId)
    {
        return $this->_entityManager->getRepository(Livre::class)->find($pId);
    }
    public function removeLivre($pId)
    {
        $livre = $this->getLivre($pId);
        if (isset($livre))
            {
                $this->_entityManager->remove($livre);
                $this->_entityManager->flush();
            }
    }
}
