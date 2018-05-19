<?php


namespace Al\Polymorphism;


trait Polymorphism
{
    public static function from(...$arguments)
    {
        $class = new \ReflectionClass(__CLASS__);
        $methods = $class->getMethods();

        $constructors = array_filter($methods, function (\ReflectionMethod $method) {
            $methodName = $method->getName();

            return
                $method->isPublic() &&
                $method->isStatic() &&
                0 === strpos($method->getName(), 'from') &&
                'from' !== $methodName
                ;
        });

        $argumentTypes = array_map(function ($argument) {
            $type = gettype($argument);

            if ('integer' === $type) {
                $type = 'int';
            }

            return $type;
        }, $arguments);

        foreach ($constructors as $constructor) {
            /** @var \ReflectionParameter $construtorParameters */
            $construtorParameters = $constructor->getParameters();
            $constructorMethodName = $constructor->getName();

            $constructorArgumentTypes = [];
            foreach ($construtorParameters as $parameter) {
                $constructorArgumentTypes[] = (string) $parameter->getType();
            }

            if ($argumentTypes === $constructorArgumentTypes) {
                $instance = call_user_func_array([__CLASS__, $constructorMethodName], $arguments);

                return $instance;
            }
        }

        throw new \Exception();
    }
}