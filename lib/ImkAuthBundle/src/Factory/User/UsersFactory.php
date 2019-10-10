<?php


namespace Imk\AuthBundle\Factory\User;


use App\Entity\Users;
use App\Entity\UsersAdvanced;
use App\Entity\UsersHistory;
use Imk\AuthBundle\Interfaces\UsersAdvancedInterface;
use Imk\AuthBundle\Interfaces\UsersInterface;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

abstract class UsersFactory implements UsersAdvancedInterface
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * UsersFactory constructor.
     *
     * @param PasswordEncoderInterface $passwordEncoder
     * @param Logger $logger
     */
    public function __construct(PasswordEncoderInterface $passwordEncoder, Logger $logger)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->logger = $logger;
    }

    /**
     * @return Users
     * @throws \Exception
     */
    public function createUser(): Users
    {
        $interfaceUser = class_implements(Users::class);
        if ($interfaceUser instanceof UsersInterface) {
            $user = new Users();
            $user->setUsername('user');
            $user->setPassword($this->passwordEncoder->encodePassword('pass', $this->getSalt()));
            $user->setSalt('salt');
            $user->setEnabled(true);
            $user->setRoles(['ROLE_USER']);
            $user->setToken(uniqid());
            $user->setUpdatedAt(new \DateTime('now'));
            return $user;
        }

        if ($interfaceUser instanceof UsersAdvancedInterface) {
            $user = new UsersAdvanced();
            $user->setUsername('user');
            $user->setPassword($this->passwordEncoder->encodePassword('pass', $this->getSalt()));
            $user->setSalt('salt');
            $user->setEnabled(true);
            $user->setRoles(['ROLE_USER']);
            $user->setToken(uniqid());
            $user->setUpdatedAt(new \DateTime('now'));
            return $user;
        }
        throw new \Exception('Error createUser');
    }


    /**
     * @return UsersHistory
     * @throws \Exception
     */
    public function createUsersHistory()
    {
        try {
            $userHistory = new UsersHistory();
            $userHistory->setAt(new \DateTime('now'));
            $userHistory->setIp('192.179.289.79');
            $userHistory->setNav('Chrome');
            $userHistory->setSession(uniqid());
            $userHistory->setOs('linux');
            return $userHistory;
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('%s %s', $exception->getCode(), $exception->getMessage()));
        }
    }


}
