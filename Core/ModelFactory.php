<?php
namespace Core;
class ModelFactory
{
    private static string $modelPath = 'App\Models\\';
    // private static string $modelPath = 'Core\\';
    public static function makeModel(string $model, array $constructor = []): object
    {
        $model = ucfirst($model);
        $namespace = self::$modelPath . $model;
        if (!class_exists($namespace)) {
            throw new \Exception("Model $namespace not found");
        } else if (!is_subclass_of($namespace, 'Core\Model')) {
            throw new \Exception('Model must be an instance of Core\Model');
        } else {
            return new $namespace($constructor);
        }
    }
}
// $user = ModelFactory::makeModel(model: 'User', constructor: ['fullname' => 'fulano', 'email' => 'beltrano@google.com']);
// echo $user->getFullname();
// echo PHP_EOL;
// echo $user->getEmail();