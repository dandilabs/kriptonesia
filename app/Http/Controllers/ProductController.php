<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function getUsdRate()
    {
        try {
            $apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=tether&vs_currencies=idr';
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                throw new \Exception('Failed to fetch USD rate');
            }

            $data = json_decode($response, true);

            if (!isset($data['tether']['idr'])) {
                throw new \Exception('Invalid API response format');
            }

            return $data['tether']['idr'];
        } catch (\Exception $e) {
            Log::error('Error getting USD rate: ' . $e->getMessage());
            return 16500; // Fallback rate
        }
    }
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:news,membership',
            'duration' => 'required|string|max:50',
            'price_usd' => 'required|numeric|min:0.01',
            'is_active' => 'required|boolean',
            'features' => 'nullable|string'
        ]);

        // Generate kode otomatis
        $code = strtolower($validated['type']) . '_' . str_replace(' ', '', $validated['duration']);

        // Hitung harga IDR
        $price = $validated['price_usd'] * $this->getUsdRate();

        // Format features
        $features = $validated['features'] ? array_filter(array_map('trim', explode("\n", $validated['features']))) : null;

        Product::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'code' => $code,
            'price' => $price,
            'price_usd' => $validated['price_usd'],
            'duration' => $validated['duration'],
            'features' => $features ? json_encode($features) : null,
            'is_active' => $validated['is_active']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:news,membership',
            'duration' => 'required|string|max:50',
            'price_usd' => 'required|numeric|min:0.01',
            'is_active' => 'required|boolean',
            'features' => 'nullable|string'
        ]);

        // Hitung harga IDR
        $price = $validated['price_usd'] * $this->getUsdRate();

        // Format features
        $features = $validated['features'] ? array_filter(array_map('trim', explode("\n", $validated['features']))) : null;

        $product->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'price' => $price,
            'price_usd' => $validated['price_usd'],
            'duration' => $validated['duration'],
            'features' => $features ? json_encode($features) : null,
            'is_active' => $validated['is_active']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function showProducts()
    {
        $rate = $this->getUsdRate();
        $products = Product::where('is_active', true)
            ->orderBy('type')
            ->orderBy('price_usd')
            ->get()
            ->groupBy('type');

        return view('blog.produk', compact('products', 'rate'));
    }
}
