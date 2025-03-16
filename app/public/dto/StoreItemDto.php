<?php

class StoreItemDto {
    private int $id;
    private Type $type;
    private int $price;
    private ?string $assetPath;

    public function __construct(int $id, Type $type, int $price, ?string $assetPath) {
        $this->id = $id;
        $this->type = $type;
        $this->price = $price;
        $this->assetPath = $assetPath;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getType(): Type {
        return $this->type;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getAssetPath(): ?string {
        return $this->assetPath;
    }
}

enum Type: string {
    case Avatar = 'avatar';
}