<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use AppBundle\Entity\Trick;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * It grants or denies permissions for actions related to community tricks (such as
 * showing, editing and deleting tricks).
 */
class TrickVoter extends Voter
{
    const SHOW = 'show';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        // this voter is only executed for three specific permissions on Trick objects
        return $subject instanceof Trick && in_array($attribute, [self::SHOW, self::EDIT, self::DELETE], true);
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $trick, TokenInterface $token)
    {
        $user = $token->getUser();
        // the user must be logged in; if not, deny permission
        if (!$user instanceof User) {
            return false;
        }
        // if the logged user is the author of the given trick, grant permission; otherwise, deny it.
        return $user === $trick->getAuthor();
    }
}
