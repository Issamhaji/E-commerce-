<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Product')
            ->setEntityLabelInPlural('Products');

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Product Name')->setHelp('This is the name of the product'),
            SlugField::new('slug')->setLabel('Slug')->setTargetFieldName('name')->setHelp('This is the Url of the product'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('This is the description of the product'),
            ImageField::new('image')
                ->setLabel('Image')
                ->setUploadDir('public/uploads')->setBasePath('uploads')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setHelp('This is the image of the product'),
            NumberField::new('price')->setLabel('Price')->setHelp('price of the product - no tax included'),
            ChoiceField::new('tva')->setLabel('TVA')->setChoices([
                '2.1%' => '2.1',
                '5.5%' => '5.5',
                '10%' => '10',
                '20%' => '20',
            ]),
            AssociationField::new('category')->setLabel('Category'),
        ];
    }

}
