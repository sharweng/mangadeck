<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip if item_images already exist
        if (DB::table('item_images')->count() > 0) {
            return;
        }

        $itemImages = [
            // Item 1
            [
                'item_id' => 1,
                'image_path' => 'items/kPan1EzVLCtT1D7KHbf5Nr9rEHHhdeTgkxbSjCr6.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:50:49',
                'updated_at' => '2025-04-05 20:50:49'
            ],
            [
                'item_id' => 1,
                'image_path' => 'items/jqWTZckiBPtCjXrNVz72oMCdwoRIBd47sfJluWkk.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:50:49',
                'updated_at' => '2025-04-05 20:50:49'
            ],
            [
                'item_id' => 1,
                'image_path' => 'items/6kCq2L9yoTQuYN11Ys10Vr85K9i21YrceE8biPO2.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:50:49',
                'updated_at' => '2025-04-05 20:50:49'
            ],
            [
                'item_id' => 1,
                'image_path' => 'items/11T6uJoC6jtSpuSPOYEQjWVHdYyU80EyT47BW9L1.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:50:49',
                'updated_at' => '2025-04-05 20:50:49'
            ],
            [
                'item_id' => 1,
                'image_path' => 'items/ocdasIntX544JZXoY80Rbc7tB3NcQTxEaPbLB1yf.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:50:49',
                'updated_at' => '2025-04-05 20:50:49'
            ],
            // Item 2
            [
                'item_id' => 2,
                'image_path' => 'items/5sxMgnySgQztfv8jXM7D2bztPS3zl2pyT8DRtswW.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:51:13',
                'updated_at' => '2025-04-05 20:51:13'
            ],
            [
                'item_id' => 2,
                'image_path' => 'items/AU2FoQxNPzcy6ItnRUxnecTQNEPPOMz58NKUWevR.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:51:13',
                'updated_at' => '2025-04-05 20:51:13'
            ],
            [
                'item_id' => 2,
                'image_path' => 'items/C4MeNAExcAb9pkWj7uuokaSYCTgXvGLIsnvqPuLb.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:51:13',
                'updated_at' => '2025-04-05 20:51:13'
            ],
            [
                'item_id' => 2,
                'image_path' => 'items/lsNxkqdXRNA1lGVVy5Wzr9VvsmCIA64eSB5BUBO1.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:51:13',
                'updated_at' => '2025-04-05 20:51:13'
            ],
            [
                'item_id' => 2,
                'image_path' => 'items/wKzVm1OfwxWBr3PCuGTAR8cUTVwDg35Fn8ta5iIH.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:51:13',
                'updated_at' => '2025-04-05 20:51:13'
            ],
            // Item 3
            [
                'item_id' => 3,
                'image_path' => 'items/sDoNMEd8mh4xUo34SCyBu6YfL9uzHkn8sMC9RiVU.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:51:26',
                'updated_at' => '2025-04-05 20:51:26'
            ],
            [
                'item_id' => 3,
                'image_path' => 'items/h3xN7tQVUARJ4k44Ch2aqK7wLVugrnVzgaoVtryf.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:51:26',
                'updated_at' => '2025-04-05 20:51:26'
            ],
            [
                'item_id' => 3,
                'image_path' => 'items/iMMbUE29eKIy2jh6y1PtaYUuGdYsWorQ97uaByjP.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:51:26',
                'updated_at' => '2025-04-05 20:51:26'
            ],
            [
                'item_id' => 3,
                'image_path' => 'items/iISwiEpB5M3oO9ABiVmZoCbHXCowCWVYE8Uwmo79.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:51:26',
                'updated_at' => '2025-04-05 20:51:26'
            ],
            [
                'item_id' => 3,
                'image_path' => 'items/q5qhXsjlR1etSqgfZlsn5iBFhL9BBgnePTKBsTwY.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:51:26',
                'updated_at' => '2025-04-05 20:51:26'
            ],
            // Item 5
            [
                'item_id' => 5,
                'image_path' => 'items/c4ZayLfpzDRKYvDmJJxqwZQ7tN02tfmc6jsWtWoB.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:53:14',
                'updated_at' => '2025-04-05 20:53:14'
            ],
            [
                'item_id' => 5,
                'image_path' => 'items/FPfDbMPx9gbOzB3fozPBZIWNmCkYubNXnl6klHQs.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:53:14',
                'updated_at' => '2025-04-05 20:53:14'
            ],
            [
                'item_id' => 5,
                'image_path' => 'items/Jgpip76nqxyWwlfs2tID5mhlIjkEM660cf49PHzO.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:53:14',
                'updated_at' => '2025-04-05 20:53:14'
            ],
            [
                'item_id' => 5,
                'image_path' => 'items/HNsoOcx9NNgAW80tyBaI6xsgTu3sf3IP5VXfAiHo.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:53:14',
                'updated_at' => '2025-04-05 20:53:14'
            ],
            [
                'item_id' => 5,
                'image_path' => 'items/1adVJfCNzQTt5dStiWTs519mTk2sItZzY3tRm64W.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:53:14',
                'updated_at' => '2025-04-05 20:53:14'
            ],
            // Item 6
            [
                'item_id' => 6,
                'image_path' => 'items/kUw1C2yVJzcNVuZTPwY5QjFIv5PhMbrN3Au304kE.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:53:33',
                'updated_at' => '2025-04-05 20:53:33'
            ],
            [
                'item_id' => 6,
                'image_path' => 'items/8SBVdptcusdrWzx2A0ij59072Xg3p4C9RrGRqpqi.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:53:33',
                'updated_at' => '2025-04-05 20:53:33'
            ],
            [
                'item_id' => 6,
                'image_path' => 'items/sSy7uihmePbCcxaGkqCyFQ9SLWWbTrVh3Sn1mqPN.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:53:33',
                'updated_at' => '2025-04-05 20:53:33'
            ],
            [
                'item_id' => 6,
                'image_path' => 'items/BKmuWmFICRXTvHJvYVXuEyno7z0KG2efCJyibXeP.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:53:33',
                'updated_at' => '2025-04-05 20:53:33'
            ],
            [
                'item_id' => 6,
                'image_path' => 'items/VE5840ueG4plupD4K0iFOalQMMCtdgDRJIbI8pqO.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:53:33',
                'updated_at' => '2025-04-05 20:53:33'
            ],
            // Item 7
            [
                'item_id' => 7,
                'image_path' => 'items/Lotda6qKtZh7COb7TCIJEr3yYcyiWdAAKaY1kk1J.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:53:51',
                'updated_at' => '2025-04-05 20:53:51'
            ],
            [
                'item_id' => 7,
                'image_path' => 'items/6poSVQuBkct7TNl8ic1rCWV7jyXAvP76QFjYpcol.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:53:51',
                'updated_at' => '2025-04-05 20:53:51'
            ],
            [
                'item_id' => 7,
                'image_path' => 'items/6YV2bFcK159IivJxHKBW7Fs5HKbYsCvMxhtXYL0R.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:53:51',
                'updated_at' => '2025-04-05 20:53:51'
            ],
            [
                'item_id' => 7,
                'image_path' => 'items/zOpSmuPnMT4JuYGoiGkRJjtfj5p3eX5xWQp2P81X.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:53:51',
                'updated_at' => '2025-04-05 20:53:51'
            ],
            [
                'item_id' => 7,
                'image_path' => 'items/QIPjXbK3FI497EnkKBfqUaTDVYFPjOHqR3R8R5nU.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:53:51',
                'updated_at' => '2025-04-05 20:53:51'
            ],
            // Item 8
            [
                'item_id' => 8,
                'image_path' => 'items/7M00GwB0RHjGQYph0tM8UUMuDc3VG8CZEIFB3muZ.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:54:14',
                'updated_at' => '2025-04-05 20:54:14'
            ],
            [
                'item_id' => 8,
                'image_path' => 'items/SAOBSuypWG8EbekYIpBjhjTzCnuyCN4GAXBIwp9j.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:54:14',
                'updated_at' => '2025-04-05 20:54:14'
            ],
            [
                'item_id' => 8,
                'image_path' => 'items/wZLJ2fX42JmAphYa6MmgAFTrki6eAvKIOdE6qJGF.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:54:14',
                'updated_at' => '2025-04-05 20:54:14'
            ],
            [
                'item_id' => 8,
                'image_path' => 'items/8AIMQVhkUi0gdKHXMVgB6pL50un8cufX7jFJ3mIm.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:54:14',
                'updated_at' => '2025-04-05 20:54:14'
            ],
            [
                'item_id' => 8,
                'image_path' => 'items/HIobpqHx4cQEk8LlaPsHsToaMj1ShNsAghQ4PL51.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:54:14',
                'updated_at' => '2025-04-05 20:54:14'
            ],
            // Item 9
            [
                'item_id' => 9,
                'image_path' => 'items/MDMu6i5SDXnYYjZ2Iz5L3wlKIkhAg0VYBMuJju4f.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:54:34',
                'updated_at' => '2025-04-05 20:54:34'
            ],
            [
                'item_id' => 9,
                'image_path' => 'items/Y2ozxpRA8zvEAy9J3tc6ugsZ5KbTtvcYsg3E75d3.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:54:34',
                'updated_at' => '2025-04-05 20:54:34'
            ],
            [
                'item_id' => 9,
                'image_path' => 'items/nOKhMFm9V6e3FIr2rqGEdoEoXokTrceDwAJgjZBK.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:54:34',
                'updated_at' => '2025-04-05 20:54:34'
            ],
            [
                'item_id' => 9,
                'image_path' => 'items/9eshjMK8ibXhKIaP4eoP9u6rU3L5D50Mlf3nEq3V.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:54:34',
                'updated_at' => '2025-04-05 20:54:34'
            ],
            [
                'item_id' => 9,
                'image_path' => 'items/sJ5cN3uniTiD4nIGv3lhOzu7l1W4LHv3KWyHu91f.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:54:34',
                'updated_at' => '2025-04-05 20:54:34'
            ],
            // Item 10
            [
                'item_id' => 10,
                'image_path' => 'items/u68Vh60wl6DANelO0Hv8WNXvILvE3EIr6Zc0ABaH.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:54:55',
                'updated_at' => '2025-04-05 20:54:55'
            ],
            [
                'item_id' => 10,
                'image_path' => 'items/pofKsr4R0LzJTS0A3EEu8b06xxYYS2jxPeaqq9aA.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:54:55',
                'updated_at' => '2025-04-05 20:54:55'
            ],
            [
                'item_id' => 10,
                'image_path' => 'items/61W7bNh92yKz6qgfw56XqgrEt09m3FJRAxjfqO4E.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:54:55',
                'updated_at' => '2025-04-05 20:54:55'
            ],
            [
                'item_id' => 10,
                'image_path' => 'items/vAsk781kKKmOl0MT4StSEwgkAWjAZ9xpyeJxC88e.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:54:55',
                'updated_at' => '2025-04-05 20:54:55'
            ],
            [
                'item_id' => 10,
                'image_path' => 'items/8eZkmFAgzfuMmABXG7oofoWVODNJbDYVKdVBMWSl.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:54:55',
                'updated_at' => '2025-04-05 20:54:55'
            ],
            // Item 11
            [
                'item_id' => 11,
                'image_path' => 'items/n0VfMZzzLrI5kgAJggD3JqNFKek07t9TnSyFoWXi.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:55:08',
                'updated_at' => '2025-04-05 20:55:08'
            ],
            [
                'item_id' => 11,
                'image_path' => 'items/NuJp2UAggMZ3iCRlivRv97ZTS0g8NX4cjdPMPooB.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:55:08',
                'updated_at' => '2025-04-05 20:55:08'
            ],
            [
                'item_id' => 11,
                'image_path' => 'items/pI0tMtTW2peLlgCRxS7xS5rkOJs5tPOwBLbhgivO.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:55:08',
                'updated_at' => '2025-04-05 20:55:08'
            ],
            [
                'item_id' => 11,
                'image_path' => 'items/cp2BXHlw0W47fiQVjYIMV1vGxonV7Y6oII1KNOnB.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:55:08',
                'updated_at' => '2025-04-05 20:55:08'
            ],
            [
                'item_id' => 11,
                'image_path' => 'items/IVGACvWbLKeJmK3zTjG2G03BV1oFsxT3hCUQAxH9.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:55:08',
                'updated_at' => '2025-04-05 20:55:08'
            ],
            // Item 12
            [
                'item_id' => 12,
                'image_path' => 'items/KQEtIdLXJuZ7ovZ5xd6csbCKOYZO9yXEa6lfr17h.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:55:21',
                'updated_at' => '2025-04-05 20:55:21'
            ],
            [
                'item_id' => 12,
                'image_path' => 'items/J9zBXwMlDyQWqZnGU5Wx2Mj7DFM1XaE2ch4RMCUA.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:55:21',
                'updated_at' => '2025-04-05 20:55:21'
            ],
            [
                'item_id' => 12,
                'image_path' => 'items/rkjHEznPnbEbvsxSv0lP2wHcmmMOcY9lRYZAObNE.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:55:21',
                'updated_at' => '2025-04-05 20:55:21'
            ],
            [
                'item_id' => 12,
                'image_path' => 'items/Gzp6kbPyjcM5LHGsUWSAIn67bARPLiZbCLm0LLPZ.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:55:21',
                'updated_at' => '2025-04-05 20:55:21'
            ],
            [
                'item_id' => 12,
                'image_path' => 'items/JcO8zru668GtG5M6VI7KaAkNMTw2UU6TcOJh7Ld4.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:55:21',
                'updated_at' => '2025-04-05 20:55:21'
            ],
            // Item 4
            [
                'item_id' => 4,
                'image_path' => 'items/Tqvqc9gAIbkxiZpCPadP5HpjgamJYuzltvyUe5CJ.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:55:49',
                'updated_at' => '2025-04-05 20:55:49'
            ],
            [
                'item_id' => 4,
                'image_path' => 'items/ZiDZ0ZiHOOMnaIC7y56gsIxVCjZQ2mUmBk8nHcn2.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:55:49',
                'updated_at' => '2025-04-05 20:55:49'
            ],
            [
                'item_id' => 4,
                'image_path' => 'items/xjFuCAfDD24qsfPHdXQSHesS8wM1iSoIFRfDRNKC.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:55:49',
                'updated_at' => '2025-04-05 20:55:49'
            ],
            [
                'item_id' => 4,
                'image_path' => 'items/OMSBQ61UZcRNrXetN4PIcDJNXj38058NrGCaGPZe.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:55:49',
                'updated_at' => '2025-04-05 20:55:49'
            ],
            [
                'item_id' => 4,
                'image_path' => 'items/qXnpmLEIRho8gojEl3Vlc1VBeEqg7cWloNypWhBK.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:55:49',
                'updated_at' => '2025-04-05 20:55:49'
            ],
            // Item 13
            [
                'item_id' => 13,
                'image_path' => 'items/4I8NFxQtC3GKYfMQFDou6D0nIdV0O0wGmkvZW0I2.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:56:09',
                'updated_at' => '2025-04-05 20:56:09'
            ],
            [
                'item_id' => 13,
                'image_path' => 'items/78p4NxyR7C9pjOU0DO5ShVlhl88T0NQVakHXaiw1.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:56:09',
                'updated_at' => '2025-04-05 20:56:09'
            ],
            [
                'item_id' => 13,
                'image_path' => 'items/y9NKCNvUsDgq481GBcD7KAfDWS5B2cjpW3XivzF3.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:56:09',
                'updated_at' => '2025-04-05 20:56:09'
            ],
            [
                'item_id' => 13,
                'image_path' => 'items/KG6sTpX50KVxCoA7GAKiRnn2u8EuHVFboptG1dq7.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:56:09',
                'updated_at' => '2025-04-05 20:56:09'
            ],
            [
                'item_id' => 13,
                'image_path' => 'items/V0bxMoMSw0pq5C7MBEc7UW8xtYmX3aWOpQT8GB74.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:56:09',
                'updated_at' => '2025-04-05 20:56:09'
            ],
            // Item 14
            [
                'item_id' => 14,
                'image_path' => 'items/HoD2LSh4vshQT8rUHDtN5MKU4guO284C4P4159gq.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => '2025-04-05 20:56:33',
                'updated_at' => '2025-04-05 20:56:33'
            ],
            [
                'item_id' => 14,
                'image_path' => 'items/qNCxzQrel10LdByIYtY7FC59xSN9Ry4jIOtIVt8K.jpg',
                'is_primary' => 0,
                'sort_order' => 2,
                'created_at' => '2025-04-05 20:56:33',
                'updated_at' => '2025-04-05 20:56:33'
            ],
            [
                'item_id' => 14,
                'image_path' => 'items/y54ANLLbou7Bq2LQmJadvj65qfFDY75hYHQFl8HD.jpg',
                'is_primary' => 0,
                'sort_order' => 3,
                'created_at' => '2025-04-05 20:56:33',
                'updated_at' => '2025-04-05 20:56:33'
            ],
            [
                'item_id' => 14,
                'image_path' => 'items/42ZgIszWi8cDzDMvKapY7pAC2j3gjGwpI6qG9wJW.jpg',
                'is_primary' => 0,
                'sort_order' => 4,
                'created_at' => '2025-04-05 20:56:33',
                'updated_at' => '2025-04-05 20:56:33'
            ],
            [
                'item_id' => 14,
                'image_path' => 'items/A6y6WhUlCU4gKjUS0mn6QVxa0GmtzQeCLRTQSlJ7.jpg',
                'is_primary' => 0,
                'sort_order' => 5,
                'created_at' => '2025-04-05 20:56:33',
                'updated_at' => '2025-04-05 20:56:33'
            ],
            // Item 15 images
            [ 'item_id' => 15, 'image_path' => 'items/vvs8s4ohByzfupNLpxC3ogOKz2CyCAewIVZ1WBj7.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 15, 'image_path' => 'items/8NTwOVkxpKE5eHxoFvLC51B2sihgudVsYUMlLPTF.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 15, 'image_path' => 'items/dcmpxuTDLdqL7vdhqB6QiPoMHVfgqFxiKzKtkEfB.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 15, 'image_path' => 'items/iJK9FVdqsyVXcQSOQ1lczykY3C260Tl2xNQbArBF.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 15, 'image_path' => 'items/xyD34pSDMCLxrpt12jTpawXbSZYa4TWOLuoGHmEh.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 16 images
            [ 'item_id' => 16, 'image_path' => 'items/uksUj7gYLlf1HJ43vkC0XnawH6AyV9FeA1Qqd55K.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 16, 'image_path' => 'items/d79zooSTPFArWXXyjiLbcobHnHdIx6w1PUfKp1Je.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 16, 'image_path' => 'items/m6cIMRXm5aVt6kfcXaDaOEh0IVoNl34Z9hYIg3Cg.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 16, 'image_path' => 'items/33KPZK5rKVnTVt1nqG8oUAr4oGmZqLZE5Fe2kQf7.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 16, 'image_path' => 'items/v5UZbisw885NiPJSVVMRATEQhKQzw5W2fiVFkGLO.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 17 images
            [ 'item_id' => 17, 'image_path' => 'items/KsB4b7BhEWva5Q3DBuGIjAOKxeNzaWcg6GJ0nGkJ.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 17, 'image_path' => 'items/UCN7LuofniipxMO2m6KVxmH5PAO2gWvSE1wzMvlV.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 17, 'image_path' => 'items/R50rKoIP0cH2KdiAdsk10XaUzh3RrRLuQ1QsnQsp.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 17, 'image_path' => 'items/L0mmgK0rEmsPp2xBXhGDhNvlQcJFW3oI4t6nKttr.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 17, 'image_path' => 'items/UoExyL10KzmbU6PcF11baYLoZrq6iQGzAJGBJ45h.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 18 images
            [ 'item_id' => 18, 'image_path' => 'items/C89k871HJTzAlGV1WQF0cMGV9f3DND2jGNA5vKBH.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 18, 'image_path' => 'items/pcrE9BNhuFaKsH36uHBVLEMfLUDBYBsqmnufLAKq.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 18, 'image_path' => 'items/aauubXca7YsAliGFxRjIk3PC25zAOcO1pYTsUQgu.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 18, 'image_path' => 'items/wza5v30nQdBO7mB1vwMMee7spOrEkHaa3J6BFnIW.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 18, 'image_path' => 'items/S06DTOxD1KVEpmvtbRHKRqrZsfg2KZSR3pzSxgoH.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 19 images
            [ 'item_id' => 19, 'image_path' => 'items/1KHYnairw1XfoaycJ4mj784budOzuiJy0EtEsykq.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 19, 'image_path' => 'items/KTnG6bkGnUWRDGzCJONk2PdkDo71vlEZwXRgLxTJ.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 19, 'image_path' => 'items/Y1JWVPpa1rb6vwtoSJGIIbY7hAveJWFU8kcJNtfE.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 19, 'image_path' => 'items/EWsEUTfv8a5V3enna0FWGuT8qgTkE7XKHKOCr3A6.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 19, 'image_path' => 'items/zptN04acJRcNW3sOYUSopB1I8DUdNMJqNCMNJ37E.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 20 images
            [ 'item_id' => 20, 'image_path' => 'items/jR1PjGHlPHcjEln7MY61OR6AoTyuQlsLCUCg4Hgd.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 20, 'image_path' => 'items/fIyRiw5OABk2uMnzHpnDAdQjFyKryuS8BdAaaoHa.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 20, 'image_path' => 'items/bKcdjoOf6M6ADmqnsG3LqYA1E8CrZvxK8Y8nLDjK.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 20, 'image_path' => 'items/3MtEUdbkavH4RGXq9LJjTFdzZn0PuoBfKmxIzvrj.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 20, 'image_path' => 'items/OQCq9qqmnZRF2PxfuvcWAnYOo0fXMmxjKTNl682g.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 21 images
            [ 'item_id' => 21, 'image_path' => 'items/FD7sLplWiygzRXKmxe0zh1lkwda2xZV1mQCd6IX3.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 21, 'image_path' => 'items/bXtqC7IW8kTmmLKJQgJwdnaeBLwJTbMetAjJqX44.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 21, 'image_path' => 'items/PiKgE7uHLMJqiGPhFvOUSLqY9Cml0M98y7snyA1k.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 21, 'image_path' => 'items/2HxPnTScMjlErO8DL0ns64iYSfTLRdpVddGLJnBB.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 21, 'image_path' => 'items/4TDJqvZ4Bwpmiycu628DnIQU8Po182wi67DP3djw.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 22 images
            [ 'item_id' => 22, 'image_path' => 'items/8cG2RBRY9DEvsnVXME9zJ2aZHQvAx60dB9BhOQx3.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 22, 'image_path' => 'items/ltm3a7ysNqdAJB7lv4zhP8CVTMy0aiUGUn8jYFvI.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 22, 'image_path' => 'items/2L5asUlA18OKCfdwurL6Zc1exM4cGuldke1TkbJC.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 22, 'image_path' => 'items/gCyYrt5NJmET81TeP2l0Zv0T7x6QfwXHoi7YYnkZ.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 22, 'image_path' => 'items/UnNEKy7QnxTrEfAWxMEXIhucYvr2vZuHOEytnbIg.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 23 images
            [ 'item_id' => 23, 'image_path' => 'items/NJMTayAqlwK2iCC8DT4sBohjksfYqjzX1N2dKVMW.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 23, 'image_path' => 'items/4W7vBjLkWIcsG8r1IzQyBWSDxKjGdvJJ6yBZoZSd.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 23, 'image_path' => 'items/zMFyrCj8GtCflsMPQOICqa5pMGW41CnmkLB4Az6j.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 23, 'image_path' => 'items/RSSkXmLHwwDZvSBksyXoEdiTHfpzlKUC74x1qr4X.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 23, 'image_path' => 'items/uAc16CCCQjpOdB5AiQRKoE6FWeSNxKWRtrDAOvpn.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 24 images
            [ 'item_id' => 24, 'image_path' => 'items/mD6AN72s7ZpKY0ku0plKE9J8IFUxv6saiddPKEVM.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 24, 'image_path' => 'items/96KxlQvFNTVB22YSSrepzY9WPVgnNQpnUb1wN0ZL.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 24, 'image_path' => 'items/i6Q40aJPi1TaBneyB6ET2VGji5NEFaMGhdPb9Qew.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 24, 'image_path' => 'items/2xZyXz4J7Zfr1CEybbsPs8iY3hBpc2DJGYwvhAF9.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 24, 'image_path' => 'items/psaXHQxroJwQVJoluhLccUfsndw8r2wF8jfvWE0U.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 25 images
            [ 'item_id' => 25, 'image_path' => 'items/JPCMvwDaU1CqDfC5kBStBOq49WdJ1JispM6RRIx0.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 25, 'image_path' => 'items/FGY4xPBrdjnXzGFmZ34YWw0PXDCGEetJD2CuUtuq.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 25, 'image_path' => 'items/y39KAGzNxBlbQepAEnUuzAZDPJkZK3wIfsB5AMkD.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 25, 'image_path' => 'items/o2oFXUZXRLNTV13ZW1HJX3IgSYBOu9AionipsLng.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 25, 'image_path' => 'items/Jtv4VRu6hlJHXn0qusxS4lLFLRk5FQyu38SEBpX5.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 26 images
            [ 'item_id' => 26, 'image_path' => 'items/do2CE1J3GIecdRbf0GqepjZhlKVqxvjK9PRviDUq.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 26, 'image_path' => 'items/UolxWCGceAvtVJ1oQYqUoN83yPFGRuDSQvGn4zvn.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 26, 'image_path' => 'items/zqLri5Z7hrARDGEgLgHq37kdYEv3L2TmUfXmY56Z.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 26, 'image_path' => 'items/vTzbGWNfG5oIR8e43ZAQarlw1sZhT4R6HsuSCUZT.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 26, 'image_path' => 'items/O2oUKjvmvNw86lQp7uupyPfU7KuWcDlc7m5spbrO.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 27 images
            [ 'item_id' => 27, 'image_path' => 'items/Pm9P2aQxtM3rmuOyBGk4TVTOShjxhVDVr4YSUnUQ.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 27, 'image_path' => 'items/53vTPAzEkUsv3aUHp99dEmFb0XcoAc6xL6pdt5Ru.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 27, 'image_path' => 'items/mV15cj3c21pTndMlJzbowmqyCqLeqPSBdKc9YIRn.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 27, 'image_path' => 'items/yWdWqbEttTeqNgIujYMy1CX5jd1gOUJEAH4BtlgK.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 27, 'image_path' => 'items/uaIQXSn048TsZsWbVrjn1r9z4Rdfg1ta5XJanrDv.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 28 images
            [ 'item_id' => 28, 'image_path' => 'items/HynjlV0yGVHS7tjai1gkwBscM9NHGVuD9klRI3Kt.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 28, 'image_path' => 'items/ieypV5kPps1rpYdDlgpM3kKcdBEaWsleP5Ifu8QC.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 28, 'image_path' => 'items/6zO6KBYroum4eMBMgCWw1jtIClZgZkkPFcxuG1zO.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 28, 'image_path' => 'items/ZgK5sEHOkNUaI2wR4FxnkVKj3Id8QCZDjETqFtyw.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 28, 'image_path' => 'items/06Gv0hESHNjPZsR7fNv3U8Ohv802vIPoJr0PjV4e.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 29 images
            [ 'item_id' => 29, 'image_path' => 'items/6E9YidwsiScETjgvaDIw7UQOo0a6nUcyQGhXoO0G.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 29, 'image_path' => 'items/KHJYVBOgBpjfpoqHq5QpvvveNv8L6fOe4jorVGZI.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 29, 'image_path' => 'items/6E96i0CvbSr33f4kMgA7jM4dml1KOsuQAKifRZBo.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 29, 'image_path' => 'items/16I58MwE9PjVHal1ialPN5WXyDvMmPo3mZH99DtG.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 29, 'image_path' => 'items/B6PJV57EKGSiclMfbjaJfxnSZA9De3trVBfx6kNT.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 30 images
            [ 'item_id' => 30, 'image_path' => 'items/CtAQ2H8I5WzTQcO8ZmzYl5umHvCOqip9JOxeAamq.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 30, 'image_path' => 'items/Lk99bYJmHdZoQtGvZBqRAcv81FGqMuAL9KTn6pbA.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 30, 'image_path' => 'items/FIevU1NTbcJHbaEKRN0awFpyiCjzXFqzAgvEYqG8.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 30, 'image_path' => 'items/7jfz8QxqJ53b3Oo7twqVFmknEXRFYgpjFQIwUa7J.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 30, 'image_path' => 'items/F4WdAf1a6vmMEnhL8S0ffCRPg1yP7iDhGIssZN6y.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 31 images
            [ 'item_id' => 31, 'image_path' => 'items/pB2UnUZRix79jeDeQZ04MvKAYVkouXvsKY6w2cBo.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 31, 'image_path' => 'items/eqKy0hVLlshnuDH1FUEgQuBKjNIFYce87KYDNerN.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 31, 'image_path' => 'items/YWjk7EBqpAfhTYgL726JHp2QB0Y7DDntSJuaG9Nx.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 31, 'image_path' => 'items/Uk7fb87S5ptk4NJm6rPxbURooi3UaWz5tnKd6BS8.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 31, 'image_path' => 'items/XpnjbKMWVvTXY1HWH1hwPj0VYPLO6PG88ga4ThtB.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 32 images
            [ 'item_id' => 32, 'image_path' => 'items/J4Vi2vXsIsP3sdnhmxKITaZ5FvvVF7zxWVQqzt2G.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 32, 'image_path' => 'items/qMNtKEoLzeEnOBJTB5aqZmDZ4F7vfAz2ooBwatBt.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 32, 'image_path' => 'items/HKikv5a2iFaIyP57fZsDl5LCD3KGYkCc8jD77QmD.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 32, 'image_path' => 'items/LF6LcFbfTtqG0AkAuDt1dzucWyGNHqBJMSewv7E8.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 32, 'image_path' => 'items/K3ykhtFucFgYCthuU6iPQHDHGxvYmNZYIZHO0Sub.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 33 images
            [ 'item_id' => 33, 'image_path' => 'items/vCgsTkop6YzuRChCRqdh378QD0xZlDp4pHZDLYGZ.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 33, 'image_path' => 'items/elX4wAhQnb0by23fwTbiGIrjVOJ33ODptbh7TI8k.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 33, 'image_path' => 'items/WyyqPcBDzWDk5bRgv66KBd8C0aDmlLo3njibCneJ.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 33, 'image_path' => 'items/RxMiAC5ru4Vy5elb07N6y5mcmq8B10kSc5WICTM6.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 33, 'image_path' => 'items/KH0Mc9EzyT0J2pMKOvFcperkJ6cD6cjkuXnFGLRW.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 34 images
            [ 'item_id' => 34, 'image_path' => 'items/FahymATP9BNfhKJf48pWbj86s4M83SVI4ila56Jm.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 34, 'image_path' => 'items/sjYC6fsLzIqbCbBZdNqHMetHA2daWpzEjEIXbL9P.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 34, 'image_path' => 'items/rWdrZWPeOBibyUw4faDdHabNunAqfx9Mvl9arzfn.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 34, 'image_path' => 'items/Gpz70V23dnS3LSlQl2qGNEZdQhKDDHmL1qdXla4i.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 34, 'image_path' => 'items/Yxv21W14el0W8csPMwhl6mwYKIMM4SgIOm8bSJLR.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 35 images
            [ 'item_id' => 35, 'image_path' => 'items/YrUHi8jGJLwTBMK3IIClaIC2kQ8kiYrkYspfUOU8.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 35, 'image_path' => 'items/iaFw7KydHI361FORrF6wbrjfB64XB38QyswxNEZ0.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 35, 'image_path' => 'items/cibfSjz3iwBwrfgmxBzpjAkPWvWMgYDIGzSF2FAA.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 35, 'image_path' => 'items/WWrXr457A1pDfkUUJb21WKscWCULj6q8Czjr5q3G.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 35, 'image_path' => 'items/NrAL27AY3aNnnZBbyGwXDDPNy75UEZ6nG8hsj7j2.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 36 images
            [ 'item_id' => 36, 'image_path' => 'items/9uy9hC0kOiN4a4nuPuX6eSQYAFrimnXoqXCxg65T.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 36, 'image_path' => 'items/mx0mm28vzAodzoAAnUKC7cg9OLAyFkvCgj3VuRHd.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 36, 'image_path' => 'items/Vrmv6WFXfrrauQYayIkfEkhlzEhRpxpuu0UXKhXp.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 36, 'image_path' => 'items/DZnUmfSQS0YOrsn0RW5FC1UwfPhBXwUV5ZX2IPgZ.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 36, 'image_path' => 'items/WyFgc2fB1Xwcl5qRb04LHXyTF3uuNoBDiaxviz9c.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 37 images
            [ 'item_id' => 37, 'image_path' => 'items/fsABWTRJmzGGdnCIUVknUzxr1aws88YezTeIKwOr.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 37, 'image_path' => 'items/rnQZE2AavmpNQfwH8NnfXFYCWThvpWqun1Bi5B5b.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 37, 'image_path' => 'items/n9WAL1SwaPb5dgUxOfICNfA8vYQ1YvUx5F33cJ0Y.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 37, 'image_path' => 'items/rOlRZZWCDQrX6CVF4ooKhVyfq59mLpvjDnDd9KEg.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 37, 'image_path' => 'items/1LqnfMBMOn0hXhYSDtu6Zua8BCflMwu3tpxdtf8N.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 38 images
            [ 'item_id' => 38, 'image_path' => 'items/JeDRHu5E35llMhnHYb5A5rYh7DOGBEm4JiacIzQ3.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 38, 'image_path' => 'items/s9f5TLcPlXlC9HT9Qx32E2WLxtSSJ3EnixSIpgxG.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 38, 'image_path' => 'items/ZxVzg9SWuLfLpIbpskKxsCgO1OHwp5RE3gvff86S.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 38, 'image_path' => 'items/acJtY4PzFnUsLPxxO84QZa21GdMfPc2rfUUykEko.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 38, 'image_path' => 'items/eSCG7jViGyK5yH5Gq1ueLUfXmvwN8zMHdTcFT5QS.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 39 images
            [ 'item_id' => 39, 'image_path' => 'items/qHMYqkSMq6YZcVtK7So58imxblGPmNApnOm1lMpa.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 39, 'image_path' => 'items/S7h1lIxRg9HqFTQxMq4sTKgTVUvjGNjnL0DjNTIm.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 39, 'image_path' => 'items/h2yF1jJzqHB2D9kqV4BbcJvX5KPsxhEkohAC62RZ.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 39, 'image_path' => 'items/iAuaPtswdteWMP6WVOSYJYXGwFUG3YWAFwKbTkq5.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 39, 'image_path' => 'items/YiseGftAJtyYi3uW3XfGYVT9Brg3GQBTm6sa9TE5.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 40 images
            [ 'item_id' => 40, 'image_path' => 'items/zARIT6gJ93I0PjEJt0hW9qqYG5Uv9fUcWLvOHgb8.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 40, 'image_path' => 'items/DspBPUomJrXBhwCAOjwYisFjA1vGdLGrC5VErMSb.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 40, 'image_path' => 'items/rYRIgFsfiG5bzIFqTvfp2azRPcV3PIXC2mVje2lv.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 40, 'image_path' => 'items/9GiJuKprc110IhwdmxBpFK11wMc3ZiTlpYCC2twn.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 40, 'image_path' => 'items/jd9Mu8DCdDLDMRbNSyknaeT7IDUuDafPlisvtg5Z.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
            // Item 41 images
            [ 'item_id' => 41, 'image_path' => 'items/sGt7VgG8tkTeJBjdnXv5G4Zc4e0kSXTkthyKH0ql.jpg', 'is_primary' => 1, 'sort_order' => 1 ],
            [ 'item_id' => 41, 'image_path' => 'items/ESRb3dkFejXgpyn9To76LNkBz6vR8vnyev9sSyIk.jpg', 'is_primary' => 0, 'sort_order' => 2 ],
            [ 'item_id' => 41, 'image_path' => 'items/t52Y1kl4sUm5NOALgDOoWeDDrQ5G9BxbMExtcCKj.jpg', 'is_primary' => 0, 'sort_order' => 3 ],
            [ 'item_id' => 41, 'image_path' => 'items/NlH5bZUYDMnriVgVCyoIlyeBQE6kIHJ3aU80GFMJ.jpg', 'is_primary' => 0, 'sort_order' => 4 ],
            [ 'item_id' => 41, 'image_path' => 'items/u6OI7evxYl2KaAEL6VeT5gSVaNsCb0Z7tNtEhKLX.jpg', 'is_primary' => 0, 'sort_order' => 5 ],
        ];

        // Insert the item images into the database
        foreach ($itemImages as $image) {
            DB::table('item_images')->insert([
                'item_id' => $image['item_id'],
                'image_path' => $image['image_path'],
                'is_primary' => $image['is_primary'],
                'sort_order' => $image['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}