<?php //3a54897d73e8527d97216354a7d62897
/** @noinspection all */

namespace Illuminate\Contracts\View {

    /**
     * @method $this extends($view, $params = [])
     * @method $this layout($view, $params = [])
     * @method $this layoutData($data = [])
     * @method $this section($section)
     * @method $this slot($slot)
     */
    class View {}
}

namespace Illuminate\Database\Eloquent {

    /**
     * @method $this onlyTrashed(Builder $builder)
     * @method int restore(Builder $builder)
     * @method $this withTrashed(Builder $builder, $withTrashed = true)
     * @method $this withoutTrashed(Builder $builder)
     */
    class Builder {}
}

namespace Illuminate\Http {

    /**
     * @method bool hasValidRelativeSignature()
     * @method bool hasValidSignature($absolute = true)
     * @method bool hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
     * @method array validate(array $rules, ...$params)
     * @method void validateWithBag(string $errorBag, array $rules, ...$params)
     */
    class Request {}
}

namespace Illuminate\Support {

    /**
     * @method $this debug()
     */
    class Collection {}
}

namespace Illuminate\Support\Facades {

    /**
     * @method void auth($options = [])
     * @method void confirmPassword()
     * @method void emailVerification()
     * @method void resetPassword()
     */
    class Route {}
}

namespace Illuminate\Testing {

    /**
     * @method $this assertDontSeeLivewire($component)
     * @method $this assertSeeLivewire($component)
     */
    class TestResponse {}

    /**
     * @method $this assertDontSeeLivewire($component)
     * @method $this assertSeeLivewire($component)
     */
    class TestView {}
}

namespace Illuminate\View {

    use Livewire\WireDirective;

    /**
     * @method WireDirective wire($name)
     */
    class ComponentAttributeBag {}

    /**
     * @method $this extends($view, $params = [])
     * @method $this layout($view, $params = [])
     * @method $this layoutData($data = [])
     * @method $this section($section)
     * @method $this slot($slot)
     */
    class View {}
}
