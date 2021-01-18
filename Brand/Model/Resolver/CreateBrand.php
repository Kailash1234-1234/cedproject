<?php

  declare(strict_types=1);

  namespace Ced\Brand\Model\Resolver;

  use Magento\Framework\Exception\AuthenticationException;

  use Magento\Framework\GraphQl\Config\Element\Field;

  use Magento\Framework\GraphQl\Exception\GraphQlInputException;

  use Magento\Framework\GraphQl\Query\ResolverInterface;

  use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

  use Ced\Brand\Model\Brandpost;

/**
 * CreateAuthor Class
 */
  class CreateBrand implements ResolverInterface
{

/**
* @var Author
*/
 private $brandpost;

/**
*
* @param Author $author
*/

  public function __construct(
     Brandpost $brandpost
) {
     $this->brandpost = $brandpost;
}

/**
* @inheritdoc
*/

  public function resolve(
     Field $field,
     $context,
     ResolveInfo $info,
     array $value = null,
     array $args = null
) {

     try {
         if (!isset($args['brand_name'])) {
             throw new GraphQlInputException(__('"brand_name" value should be specified'));
         }

         if (!isset($args['brand_desc'])) {
             throw new GraphQlInputException(__('"brand_desc" value should be specified'));
         }

         if (!isset($args['brand_status'])) {
         throw new GraphQlInputException(__('"Brand_status" value should be specified'));
         }

         $this->brandpost->addData($args);
         $this->brandpost->getResource()->save($this->brandpost);
         if($this->brandpost->getBrandId())
         return ['message'=>'Author Successfully Created', 'brand_id' => $this->brandpost->getBrandId()];
         else
          return ['message'=>'Not Able To Create Author'];
     } catch (AuthenticationException $e) {
         throw new GraphQlInputException(
             __($e->getMessage())
         );
     }
}
}