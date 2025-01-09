<?php

namespace App\Collection;

class InvoiceCollection extends Collection
{

}

// class InvoiceCollection implements Iterator
// {
//     protected array $collections;

//     public function __construct(array $collections)
//     {
//         $this->collections = $collections;
//     }

//     public function current(): mixed
//     {
//         echo __METHOD__ . PHP_EOL;
//         return current($this->collections);
//     }

//     public function next(): void
//     {
//         echo __METHOD__ . PHP_EOL;
//         next($this->collections);

//     }

//     public function key(): mixed
//     {
//         echo __METHOD__ . PHP_EOL;
//         return key($this->collections);

//     }
//     public function valid(): bool
//     {
//         echo __METHOD__ . PHP_EOL;
//         return current($this->collections) !== false;

//     }

//     public function rewind(): void
//     {
//         echo __METHOD__ . PHP_EOL;
//         reset($this->collections);

//     }
// }
