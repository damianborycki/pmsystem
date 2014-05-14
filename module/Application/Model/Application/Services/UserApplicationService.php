<?php

namespace Application\Model\Application\Services\User;

use Zend\Crypt\Password\Bcrypt;

class UserApplicationService {
    
    /**
     * weryfikacja hasla uzytkownika - zahashowanie bcryptem i porownanie z hashem hasla uzytkownika przetrzymywanym na bazie
     * @param type $user - encja usera
     * @param type $password - haslo uzytkownika (niezahashowane)
     * @return type - true - verified, false - verification failed
     */
    static function verifyPassword($user, $password) {
        $bcrypt = new Bcrypt();
        $bcrypt->setCost('14');
        return $bcrypt->verify($password, $user->getPassword());
    }
}

?>