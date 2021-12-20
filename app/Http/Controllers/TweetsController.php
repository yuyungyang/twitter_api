<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TweetsCreateRequest;
use App\Http\Requests\TweetsUpdateRequest;
use App\Repositories\TweetsRepository;
use App\Validators\TweetsValidator;

/**
 * Class TweetsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TweetsController extends Controller
{
    protected $_tweets_per_page = 10;

    /**
     * @var TweetsRepository
     */
    protected $repository;

    /**
     * @var TweetsValidator
     */
    protected $validator;

    /**
     * TweetsController constructor.
     *
     * @param TweetsRepository $repository
     * @param TweetsValidator $validator
     */
    public function __construct(TweetsRepository $repository, TweetsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['uuid'];

        $this->repository->pushCriteria(app('App\Criteria\TweetsCriteriaCriteria'));
        $tweets = $this->repository->paginate($this->_tweets_per_page, $columns);
        
        return response()->json([
            $tweets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TweetsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TweetsCreateRequest $request)
    {
        try {
            $arrRequest = $request->all();

            $this->validator->with($arrRequest)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $arrRequest['modified_at'] = date('Y/m/d H:i:s');
            $tweet = $this->repository->create($arrRequest);

            $response = [
                'message' => 'Tweets created.',
                'data'    => $tweet->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = ['uuid', 'users_uuid', 'is_retweet', 'total_stars', 'tweet_text', 'created_at'];

        $tweet = $this->repository->find($id, $columns);

        return response()->json([
            'data' => $tweet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TweetsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TweetsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tweet = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tweets updated.',
                'data'    => $tweet->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Tweets deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tweets deleted.');
    }
}
