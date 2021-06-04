<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\PostRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Support\Collection;
use App\Models\Post;
use App\Models\PostVoucher;
use App\Traits\UpdateViewedPost;
use App\Utils\VoucherGenerateCode;
use Illuminate\Support\Facades\DB;
use App\Exceptions\SystemErrorException;
use App\Exceptions\VoucherNotAvailableException;

class BlogController extends FrontendController
{
    use UpdateViewedPost;

    public $postRepository;
    public $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index($category_id = null)
    {
        $categories = $this->categoryRepository->getCategories();
        if(isset($category_id)) {
            $currentCategory = $this->categoryRepository->model->find($category_id);
            $posts = (new Collection($currentCategory->posts))->paginate(10);
        } else {
            $posts = $this->postRepository->getPosts(['per_page' => 10]);
        }
        return view('frontend.blog.index', compact('posts'));
    }

    public function details($post_id)
    {
        $currentPost = Post::findOrFail($post_id);
        if(\Auth::check()) {
            dispatch(new \App\Jobs\IncrementReadCountPost(\Auth::user(), $currentPost));
            $this->updateViewedPost($currentPost);
        }
        return view('frontend.blog.details', compact('currentPost'));
    }

    // Type of request: { "target": post_id }
    public function get_voucher_code(Request $request)
    {
        if(!\Auth::check() || empty($request->voucher)) return response()->json([
            'title' => 'Authorization',
            'message' => 'Please login/register to get code.'
        ], 400);
        DB::beginTransaction();
        try {
            $post = Post::where('id', '=', $request->voucher['target'])->lockForUpdate()->get()->first();
            if($post->voucher_enable == true && $post->voucher_quantity > 0) {
                $post->decrement('voucher_quantity');
            } else {
                throw new VoucherNotAvailableException();
            }
            $newVoucher =  PostVoucher::create([
                'user_id' => \Auth::user()->id,
                'post_id' => $post->id,
                'code' => VoucherGenerateCode::generate_coupons(1, 10)[0]
            ]);
            if(empty($newVoucher)) throw new SystemErrorException('Wrong', "You cann't get more voucher!");
            DB::commit();
            return response()->json([
                'title' => 'Get voucher code success',
                'message' => 'Congrat! You had just get a voucher for this post.',
                'code' => $newVoucher->code
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    private function checkVoucherEnable(Post $post) : bool
    {
        if($post->voucher_enable == true) return true;
        return false;
    }

    private function checkVoucherQuantity(Post $post) : bool
    {
        if($post->voucher_quantity > 0) return true;
        return false;
    }
}
