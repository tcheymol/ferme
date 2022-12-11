<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('product')
            ->setEntityLabelInPlural('products');
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('name'),
            IntegerField::new('weight')->setLabel('weight_g'),
            NumberField::new('price')->setLabel('price_e'),
            NumberField::new('kgPrice')->setLabel('kgPrice'),
            NumberField::new('quantity')->setLabel('quantity'),
            BooleanField::new('thisWeek')->setLabel('thisWeek')->onlyOnForms(),
            BooleanField::new('showcased')->setLabel('showcased')->onlyOnForms(),
            ImageField::new('imageName')->setLabel('image')
                ->setUploadDir('/public/images')
                ->setBasePath('/images'),
        ];
    }
}
