<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


abstract class BaseApiController extends AbstractController
{
    protected $serializer;
    protected $em;
    protected $logger;
    protected $security;
    protected $validator;
    protected $customSerializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em, LoggerInterface $logger, Security $security, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->em = $em;
        $this->logger = $logger;
        $this->security = $security;
        $this->validator = $validator;

        $normalizer = [new JsonSerializableNormalizer()];
        $this->customSerializer = new Serializer($normalizer, [new JsonEncoder()]);
    }
}
