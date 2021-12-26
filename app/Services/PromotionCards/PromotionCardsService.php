<?php

declare(strict_types=1);

namespace App\Services\PromotionCards;

use App\Http\Requests\PromotionCards\PromotionCardsRequest;
use App\Models\PromotionCards\PromotionCards;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Json;

class PromotionCardsService
{
    public function save(PromotionCardsRequest $request): PromotionCards
    {
        $promotionCards = new PromotionCards();
        $promotionCards->fill($request->all(
            [
                PromotionCards::ATTR_NAME,
                PromotionCards::ATTR_POSITION,
                PromotionCards::ATTR_URL,
                PromotionCards::ATTR_STATUS
            ]
        ));

        if ($request->file('img')) {
            $promotionCards->img = $request->file('img')->store('promotionCards', 'public');
        }

        $promotionCards->save();

        $this->writeToFile();

        return $promotionCards;
    }

    /**
     * @param PromotionCardsRequest $request
     * @param $id
     * @return PromotionCards
     */
    public function edit(PromotionCardsRequest $request, $id): PromotionCards
    {
        $model = PromotionCards::findOrFail($id);
        $model->fill($request->all(
            [
               PromotionCards::ATTR_NAME,
               PromotionCards::ATTR_POSITION,
               PromotionCards::ATTR_URL,
               PromotionCards::ATTR_STATUS
            ]
        ));

        if ($request->file('img')) {
            $model->img = $request->file('img')->store('promotionCards', 'public');
        }

        $model->save();

        $this->writeToFile();

        return $model;
    }

    public function delete($id): PromotionCards
    {
        PromotionCards::findOrFail($id)->delete();
        $this->writeToFile();
    }

    public function writeToFile() {
        $json = PromotionCards::all()->toJson();
        $content = 'const promotions = ' . $json . '; export default promotions;';
        $path = resource_path() . '/spa/src/pages/PromotionsPage/data.js';
        File::put($path, $content);
    }

}
