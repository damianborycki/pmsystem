<?php

/* enum dla definicji typow kontekstu danego custom fielda
 * przy dodawaniu Issue dla projektu,
 * ktory ma custom fielda, zapisujac jego wartosc do
 * FieldsValues korzystamy z FieldContextEnum::Issue jako
 * CONTEXTID. Analogicznie Tracker.
 */

namespace Application\Model\Domain;

class FieldContextEnum {
    const Issue = 0;
    const Tracker = 1;
}