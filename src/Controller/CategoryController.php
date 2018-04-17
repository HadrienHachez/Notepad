<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryController extends Controller
{
    /**
     * @Route("/categories/new", name="new_category")
     * @param mixed $request
     * @return mixed
     */
    public function newCategory(Request $request)
    {
        $category = new Category();
        $category->setWording('Write a wording');

        $form = $this->createFormBuilder($category)
            ->add('wording', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'SAVE'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $category = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('notes');
        }

        return $this->render('category/newCategory.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/categories/{id}", name="category_show")
     * @param mixed $category
     * @return mixed
     */
    public function show(Category $category)
    {
        $notes = $category->getNotes();

        return $this->render('note/index.html.twig', array(
            'notes' => $notes,
        ));
    }
}
?>
