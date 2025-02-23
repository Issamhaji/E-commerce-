<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users');

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email')->setLabel('Email')->onlyOnIndex(),
            TextField::new('firstname')->setLabel('First Name'),
            TextField::new('lastname')->setLabel('Last Name'),
        ];
    }

}
